<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Http\Services\Faq\FaqService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    protected $service;

    public function __construct(FaqService $service)
    {
        $this->service = $service;
    }

    /**
     * Show FAQ list page
     */
    public function index()
    {
        return view('backend.faq.index');
    }

    /**
     * Return DataTable JSON for FAQs
     */
    public function getDataTable(Request $request)
    {
        return DataTables::of($this->service->getAllQuery())
            ->addIndexColumn() // Auto SL
            ->addColumn('image', function ($faq) {
                if ($faq->image) {
                    return '<img src="' . $faq->image_url . '" width="60" height="40" style="object-fit:cover;" class="rounded">';
                }
                return '<span class="text-muted">—</span>';
            })
            ->addColumn('status', function ($faq) {
                if ($faq->status) {
                    return '<span class="badge bg-success-subtle text-success px-3">Active</span>';
                }
                return '<span class="badge bg-secondary-subtle text-secondary px-3">Inactive</span>';
            })
            ->addColumn('actions', fn($item) => action_buttons([
                edit_column(route('faq.edit', $item->id)),
                delete_column(route('faq.delete', $item->id)),
            ]))
            ->rawColumns(['image', 'status', 'actions'])
            ->make(true);
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('backend.faq.create');
    }

    /**
     * Store new FAQ
     */
    public function store(FaqRequest $request)
    {
        $this->service->create($request->validated());
        return redirect()->route('faq.list')->with('success', 'FAQ created successfully.');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $data['faq'] = $this->service->getById($id);
        return view('backend.faq.create', $data);
    }

    /**
     * Update FAQ
     */
    public function update(FaqRequest $request, $id)
    {
        $faq = $this->service->getById($id);
        $this->service->update($faq, $request->validated());
        return redirect()->route('faq.list')->with('success', 'FAQ updated successfully.');
    }

    /**
     * Delete FAQ
     */
    public function destroy($id)
    {
        $faq = $this->service->getById($id);
        $this->service->delete($faq);
        return redirect()->route('faq.list')->with('success', 'FAQ deleted successfully.');
    }
}
