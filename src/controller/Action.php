<?php

namespace App\controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

abstract class Action
{

    protected Request $request;
    protected Response $response;
    protected array $args;

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        $this->setUp();

        return $this->action();
    }

    abstract protected function action(): Response;

    protected function setUp(): void{

    }

    /**
     * @return array|object
     */
    protected function getFormData()
    {
        return $this->request->getParsedBody();
    }

    protected function getQueryParams()
    {
        $queryParams = $this->request->getQueryParams();

        $queryParams['search'] = $queryParams['search'] ?? null;
        $queryParams['page'] = $queryParams['page'] ?? 1;

        return $queryParams;
    }

    /**
     * @param string $template
     * @param array $data
     * @return Response
     */
    protected function respondWithData(array $payload, int $statusCode = 200): Response
    {
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);

        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($statusCode);
    }

    /**
     * @param string $template
     * @param array $data
     * @return Response
     */
    protected function view(string $template, array $data): Response
    {

        $view = Twig::fromRequest($this->request);

        return $view->render($this->response, $template,$data);
    }

    protected function redirect(string $location): Response
    {

        $basePath = \Slim\Routing\RouteContext::fromRequest($this->request)->getBasePath();

        return $this->response
            ->withHeader('Location',  $basePath . $location)
            ->withStatus(302);

    }

}