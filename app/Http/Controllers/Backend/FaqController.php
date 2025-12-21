<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Http\Services\Faq\FaqService;

class FaqController extends Controller
{
    protected $service;

    public function __construct(FaqService $service)
    {
        $this->service = $service;
    }

    // List FAQs
    public function index()
    {
        $data['faqs'] = $this->service->getAllPaginated(10); // Service handles fetching
        return view('backend.faq.index',$data);
    }

    // Show create form
    public function create()
    {
        return view('backend.faq.create'); // Separate blade for create/edit
    }

    // Store new FAQ
    public function store(FaqRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('faq.list')->with('success', 'FAQ created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $data['faq'] = $this->service->getById($id);
        return view('backend.faq.create', $data);
    }

    // Update FAQ
    public function update(FaqRequest $request, $id)
    {
        $faq = $this->service->getById($id);
        $this->service->update($faq, $request->validated());
        return redirect()->route('faq.list')->with('success', 'FAQ updated successfully.');
    }

    // Delete FAQ
    public function destroy($id)
    {
        $faq = $this->service->getById($id);
        $this->service->delete($faq);
        return redirect()->route('faq.list')->with('success', 'FAQ deleted successfully.');
    }
}
