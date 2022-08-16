<?php

declare(strict_types=1);

namespace Work\Model\Table;

use Laminas\Crypt\Password\Bcrypt;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\Adapter\Adapter;
use Laminas\Filter;
use Laminas\I18n;
use Laminas\InputFilter;
use Laminas\Validator;

class UsersTable extends AbstractTableGateway
{
    protected $table = 'users';

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }
    # next i want us to create a method that will help us filter and validate our registerform data
    public function getRegisterFormFilter()
    {
        $inputFilter = new InputFilter\InputFilter();
        $factory = new InputFilter\Factory();

        # filter and validate username field
        $inputFilter->add($factory->createInput([
            'name' => 'name',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class],
                ['name' => I18n\Filter\Alnum::class]
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
                [
                    'name' => I18n\Validator\Alnum::class,
                    'options' => [
                        'messages' => [
                            I18n\Validator\Alnum::NOT_ALNUM => 'Name must consist of alphanumeric characters only'
                        ]
                    ]
                ],
                [
                    'name' => Validator\StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 2,
                        'max' => 25,
                        'messages' => [
                            Validator\StringLength::TOO_SHORT => 'Name must have at least 2 characters',
                            Validator\StringLength::TOO_LONG => 'Name must have at most 25 characters'
                        ]
                    ]
                ],
                [
                    'name' => Validator\Db\NoRecordExists::class,
                    'options' => [
                        'table' => $this->table,
                        'field' => 'name',
                        'adapter' => $this->adapter
                    ]
                ]
            ]
        ]));

        #filter and validate password field
        $inputFilter->add($factory->createInput([
            'name' => 'password',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class]
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
                [
                    'name' => Validator\StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 8,
                        'max' => 25,
                        'messages' => [
                            Validator\StringLength::TOO_SHORT => 'Password must have at least 8 characters',
                            Validator\StringLength::TOO_LONG => 'Password must have at most 25 characters'
                        ]
                    ]
                ]
            ]
        ]));

        #filter and validate confirm_password field
        $inputFilter->add($factory->createInput([
            'name' => 'confirm_password',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class]
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
                [
                    'name' => Validator\StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 8,
                        'max' => 25,
                        'messages' => [
                            Validator\StringLength::TOO_SHORT => 'Password must have at least 8 characters',
                            Validator\StringLength::TOO_LONG => 'Password must have at most 25 characters'
                        ]
                    ]
                ],
                [
                    'name' => Validator\Identical::class,
                    'options' => [
                        'token' => 'password', # here we simply name a field we want to compare against
                        'messages' => [
                            Validator\Identical::NOT_SAME => 'Passwords do not match. Make sure they match!'
                        ]
                    ]
                ]
            ]
        ]));

        # Filter and validate
        $inputFilter->add($factory->createInput([
            'name' => 'surname',
            'required' => true,
            'filters' => [
                ['name' => Filter\StripTags::class],
                ['name' => Filter\StringTrim::class],
                ['name' => I18n\Filter\Alnum::class]
            ],
            'validators' => [
                ['name' => Validator\NotEmpty::class],
                [
                    'name' => I18n\Validator\Alnum::class,
                    'options' => [
                        'messages' => [
                            I18n\Validator\Alnum::NOT_ALNUM => 'Name must consist of alphanumeric characters only'
                        ]
                    ]
                ],
                [
                    'name' => Validator\StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 2,
                        'max' => 25,
                        'messages' => [
                            Validator\StringLength::TOO_SHORT => 'Name must have at least 2 characters',
                            Validator\StringLength::TOO_LONG => 'Name must have at most 25 characters'
                        ]
                    ]
                ],
                [
                    'name' => Validator\Db\NoRecordExists::class,
                    'options' => [
                        'table' => $this->table,
                        'field' => 'surname',
                        'adapter' => $this->adapter
                    ]
                ]
            ]
        ]));

        return $inputFilter;
    }

    public function insertAccount(array $data)
    {
        $values = [
            'name' => ucfirst(mb_strtolower($data['name'])),
            'surname' => ucfirst(mb_strtolower($data['surname'])),
            'email' => $data['email'],
            'password' => $data['password'],
            'textarea' => $data['textarea'],
            //  'multi-checkbox' => $data['multi-checkbox']
            'radio' => $data['radio'],
            // 'datetime' => $data['datetime'],
        ];

        $sqlQuery = $this->sql->insert()->values($values);
        $sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);

        return $sqlStmt->execute();
    }

    //
}
