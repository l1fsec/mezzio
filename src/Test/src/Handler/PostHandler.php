<?php

declare(strict_types=1);

namespace Test\Handler;

use Test\Model\Table\PostTable;
use Laminas\Db\Adapter\Adapter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Test\Form\RegisterForm;
use Laminas\I8n\Translator\Translator;

//use Psr\Http\Server\MiddlewareInterface;
//use Test\Base\BaseHandler;

class PostHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    private $postData;

    /**
     * @var PostTable
     */
    private $postTable;

    /**
     * @var RegisterForm
     */
    private $registerForm;

    public function __construct(RegisterForm $registerform, TemplateRendererInterface $renderer)
    {
        $this->registerForm = $registerform;
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {

        return new HtmlResponse($this->renderer->render(
            'test::post',
            [
                'form' => $this->registerForm
            ]
            // parameters to pass to template
        ));
    }
}
