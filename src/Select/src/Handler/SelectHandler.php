<?php

declare(strict_types=1);

namespace Select\Handler;

use Select\Model\Table\SelectModel;
use Laminas\Db\Adapter\Adapter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class SelectHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    /**
     * @var SelectModel
     */
    private $selectModel;

    public function __construct(SelectModel $selectModel, TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
        $this->selectModel = $selectModel;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // Do some work...
        // Render and return a response:
        return new HtmlResponse($this->renderer->render(
            'select::select',
            [
                'userList' => $this->selectModel->getAll(),
                'userList1' => $this->selectModel->getAll(),
                'userList2' => $this->selectModel->getAll(),

            ]
            // parameters to pass to template
        ));
    }
}
