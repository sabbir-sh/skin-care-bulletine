@extends('backend.layouts.app')

@section('content')
    <div style="padding:30px; font-family:Arial,sans-serif; background:#f8f9fa; min-height:100vh;">

        {{-- Header --}}
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:40px;">
            <h1 style="margin:0; color:#343a40;">Dashboard Overview 👋</h1>
        </div>

        {{-- Blog Stats Cards --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px,1fr)); gap:20px; margin-bottom:40px;">
            <div
                style="background:white; border-radius:12px; padding:25px; box-shadow:0 6px 15px rgba(0,0,0,0.08); position:relative; overflow:hidden;">
                <div style="font-size:14px; color:#6c757d; text-transform:uppercase; margin-bottom:8px;">Total Posts</div>
                <div style="font-size:32px; font-weight:bold; color:#343a40;">{{ $total }}</div>
                <div
                    style="position:absolute; top:0; right:0; background:#007bff; width:60px; height:60px; border-radius:50%; opacity:0.1;">
                </div>
            </div>

            <div
                style="background:white; border-radius:12px; padding:25px; box-shadow:0 6px 15px rgba(0,0,0,0.08); position:relative; overflow:hidden;">
                <div style="font-size:14px; color:#6c757d; text-transform:uppercase; margin-bottom:8px;">Published Posts
                </div>
                <div style="font-size:32px; font-weight:bold; color:#343a40;">{{ $published }}</div>
                <div
                    style="position:absolute; top:0; right:0; background:#28a745; width:60px; height:60px; border-radius:50%; opacity:0.1;">
                </div>
            </div>

            <div
                style="background:white; border-radius:12px; padding:25px; box-shadow:0 6px 15px rgba(0,0,0,0.08); position:relative; overflow:hidden;">
                <div style="font-size:14px; color:#6c757d; text-transform:uppercase; margin-bottom:8px;">Draft Posts</div>
                <div style="font-size:32px; font-weight:bold; color:#343a40;">{{ $draft }}</div>
                <div
                    style="position:absolute; top:0; right:0; background:#dc3545; width:60px; height:60px; border-radius:50%; opacity:0.1;">
                </div>
            </div>
        </div>

        {{-- Recent Blogs Table --}}
        <div style="background:white; border-radius:12px; padding:25px; box-shadow:0 6px 15px rgba(0,0,0,0.08);">
            <h2
                style="margin-top:0; margin-bottom:20px; font-size:22px; color:#007bff; border-bottom:1px solid #e9ecef; padding-bottom:10px;">
                Recent Blog Posts</h2>
            <table style="width:100%; border-collapse:collapse; font-size:14px;">
                <thead>
                    <tr style="background:#f1f1f1; color:#343a40; font-weight:600; text-align:left;">
                        <th style="padding:12px 15px;">Title</th>
                        <th style="padding:12px 15px;">Status</th>
                        <th style="padding:12px 15px;">Created At</th>
                        <th style="padding:12px 15px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\BlogPost::latest()->take(10)->get() as $blog)
                        <tr style="border-bottom:1px solid #e9ecef; transition:background 0.3s;"
                            onmouseover="this.style.background='#f9f9f9';" onmouseout="this.style.background='white';">
                            <td style="padding:12px 15px;">{{ Str::limit($blog->title, 50) }}</td>
                            <td style="padding:12px 15px;">
                                @if($blog->status == 1)
                                    <span
                                        style="background:#28a745; color:white; font-size:12px; font-weight:bold; padding:3px 8px; border-radius:12px;">Published</span>
                                @else
                                    <span
                                        style="background:#dc3545; color:white; font-size:12px; font-weight:bold; padding:3px 8px; border-radius:12px;">Draft</span>
                                @endif
                            </td>
                            <td style="padding:12px 15px;">{{ $blog->created_at->format('M d, Y') }}</td>
                            <td style="padding:12px 15px;">
                                <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" style="color:#6c757d;">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Category-wise Blog Count --}}
        <div
            style="margin-top:40px; background:white; border-radius:12px; padding:25px; box-shadow:0 6px 15px rgba(0,0,0,0.08);">
            <h2
                style="margin-top:0; margin-bottom:20px; font-size:22px; color:#007bff; border-bottom:1px solid #e9ecef; padding-bottom:10px;">
                Blog Posts by Category
            </h2>

            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px,1fr)); gap:20px;">
                @foreach(\App\Models\Category::withCount('blogs')->get() as $category)
                    <div
                        style="background:#f8f9fa; border-radius:10px; padding:20px; text-align:center; box-shadow:0 4px 10px rgba(0,0,0,0.05);">
                        <div style="font-size:16px; font-weight:bold; color:#343a40; margin-bottom:10px;">
                            {{ $category->name }}
                        </div>
                        <div style="font-size:28px; font-weight:bold; color:#007bff;">
                            {{ $category->blogs_count }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
@endsection