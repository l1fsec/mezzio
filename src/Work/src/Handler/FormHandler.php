<?php

// * @author     Jan Pliska
// * Testovani formulare

declare(strict_types=1);

namespace Work\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Server\MiddlewareInterface;
use Work\Form\DataForm;
use Work\Model\Table\UsersTable;

class FormHandler implements MiddlewareInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @var DataForm
     */
    private $dataForm;
    /**
     * @var UsersTable
     */
    private $usersTable;


    public function __construct(
        DataForm $dataForm,
        UsersTable $usersTable,
        TemplateRendererInterface $renderer
    ) {
        $this->dataForm = $dataForm;
        $this->renderer = $renderer;
        $this->usersTable = $usersTable;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {

        # check if the request is a form post
        if ($request->getMethod() === 'POST') {

            $this->dataForm->setInputFilter($this->usersTable->getRegisterFormFilter());
            $this->dataForm->setData($request->getParsedBody());

            if ($this->dataForm->isValid()) {
                $this->usersTable->insertAccount($request->getParsedBody());
                $response = $handler->handle($request);



                if ($response->getStatusCode() !== 302) {
                    // ! tady byl predtim Flash ale ten hazi chybu **Call to a member function flash() on null** prozatim tu nebude
                    return new RedirectResponse('/login');
                }

                return $response;
            }
        }

        return new HtmlResponse(
            $this->renderer->render(
                'work::form',
                [
                    'form' => $this->dataForm
                ]
            )
        );
    }
}
