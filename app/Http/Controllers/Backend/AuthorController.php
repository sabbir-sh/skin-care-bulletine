<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Http\Services\Author\AuthorService;
use App\Models\Author;

class AuthorController extends Controller
{
    protected $service;

    public function __construct(AuthorService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $authors = $this->service->getAll();
        return view('backend.author.index', compact('authors'));
    }

    public function create()
    {
        return view('backend.author.create');
    }

    public function store(AuthorRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()
            ->route('author.list')
            ->with('success', 'Author created successfully.');
    }

    public function edit($id)
    {
        $author = Author::findOrFail($id);

        return view('backend.author.create', compact('author'));
    }

    public function update(AuthorRequest $request, $id)
    {
        $author = Author::findOrFail($id);

        $this->service->update($author, $request->validated());

        return redirect()
            ->route('author.list')
            ->with('success', 'Author updated successfully.');
    }

    public function destroy($id)
    {
        $author = Author::findOrFail($id);

        $this->service->delete($author);

        return redirect()
            ->route('author.list')
            ->with('success', 'Author deleted successfully.');
    }
}
