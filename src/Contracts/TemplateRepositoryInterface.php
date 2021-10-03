<?php

namespace Adminetic\Blog\Contracts;

use Adminetic\Blog\Models\Admin\Template;
use Adminetic\Blog\Http\Requests\TemplateRequest;

interface TemplateRepositoryInterface
{
    public function indexTemplate();

    public function createTemplate();

    public function storeTemplate(TemplateRequest $request);

    public function showTemplate(Template $Template);

    public function editTemplate(Template $Template);

    public function updateTemplate(TemplateRequest $request, Template $Template);

    public function destroyTemplate(Template $Template);
}
