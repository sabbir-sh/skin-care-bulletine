@extends('backend.layouts.app')

@section('content')
<div style="padding: 30px; background: #f4f7fe; min-height: 100vh; font-family: 'Plus Jakarta Sans', sans-serif;">

    {{-- ১. হেডার সেকশন --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px;">
        <div>
            <h2 style="margin: 0; color: #1b254b; font-weight: 800; font-size: 28px;">Dashboard Overview</h2>
            <p style="color: #a3aed0; margin: 5px 0 0; font-weight: 500;">Welcome back to your blood donation portal admin.</p>
        </div>
        <div style="background: #fff; padding: 10px 20px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); font-weight: 600; color: #422afb;">
            <i class="bi bi-calendar3 me-2"></i> {{ date('d M, Y') }}
        </div>
    </div>

    {{-- ২. স্ট্যাটাস কার্ডস (নতুন ডিজাইন) --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 25px; margin-bottom: 40px;">
        
        <div style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 20px;">
            <div style="width: 60px; height: 60px; background: #f4f7fe; border-radius: 15px; display: flex; align-items: center; justify-content: center; color: #422afb; font-size: 24px;">
                <i class="bi bi-file-earmark-text-fill"></i>
            </div>
            <div>
                <p style="margin: 0; color: #a3aed0; font-size: 14px; font-weight: 600;">Total Posts</p>
                <h3 style="margin: 0; color: #1b254b; font-weight: 700; font-size: 24px;">{{ $total }}</h3>
            </div>
        </div>

        <div style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 20px;">
            <div style="width: 60px; height: 60px; background: #e6f9f0; border-radius: 15px; display: flex; align-items: center; justify-content: center; color: #01b574; font-size: 24px;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div>
                <p style="margin: 0; color: #a3aed0; font-size: 14px; font-weight: 600;">Published</p>
                <h3 style="margin: 0; color: #1b254b; font-weight: 700; font-size: 24px;">{{ $published }}</h3>
            </div>
        </div>

        <div style="background: white; border-radius: 20px; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 20px;">
            <div style="width: 60px; height: 60px; background: #fff5f5; border-radius: 15px; display: flex; align-items: center; justify-content: center; color: #ee5d50; font-size: 24px;">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <p style="margin: 0; color: #a3aed0; font-size: 14px; font-weight: 600;">Draft Posts</p>
                <h3 style="margin: 0; color: #1b254b; font-weight: 700; font-size: 24px;">{{ $draft }}</h3>
            </div>
        </div>

    </div>

    {{-- ৩. টেবিল এবং ক্যাটাগরি সেকশন (২ কলাম লেআউট) --}}
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        
        {{-- টেবিল সেকশন --}}
        <div style="background: white; border-radius: 25px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.02);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                <h4 style="margin: 0; color: #1b254b; font-weight: 700;">Recent Articles</h4>
                <a href="{{ route('blog.list') }}" style="color: #422afb; text-decoration: none; font-size: 14px; font-weight: 600;">See all</a>
            </div>
            
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
                    <thead>
                        <tr style="text-align: left; color: #a3aed0; font-size: 13px; text-transform: uppercase; letter-spacing: 1px;">
                            <th style="padding: 10px 15px;">Title</th>
                            <th style="padding: 10px 15px;">Status</th>
                            <th style="padding: 10px 15px;">Created</th>
                            <th style="padding: 10px 15px; text-align: center;">Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\BlogPost::latest()->take(7)->get() as $blog)
                        <tr style="background: #f8fafc; border-radius: 15px; transition: 0.3s;">
                            <td style="padding: 15px; border-radius: 15px 0 0 15px;">
                                <span style="color: #1b254b; font-weight: 600;">{{ Str::limit($blog->title, 40) }}</span>
                            </td>
                            <td style="padding: 15px;">
                                @if($blog->status == 1)
                                    <span style="background: #e6f9f0; color: #01b574; padding: 5px 12px; border-radius: 10px; font-size: 11px; font-weight: 700;">PUBLISHED</span>
                                @else
                                    <span style="background: #fff5f5; color: #ee5d50; padding: 5px 12px; border-radius: 10px; font-size: 11px; font-weight: 700;">DRAFT</span>
                                @endif
                            </td>
                            <td style="padding: 15px; color: #707eae; font-size: 13px;">
                                {{ $blog->created_at->format('M d, Y') }}
                            </td>
                            <td style="padding: 15px; border-radius: 0 15px 15px 0; text-align: center;">
                                <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" style="color: #422afb; background: #fff; width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ক্যাটাগরি সেকশন --}}
        <div style="background: white; border-radius: 25px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.02);">
            <h4 style="margin-top: 0; margin-bottom: 25px; color: #1b254b; font-weight: 700;">Categories Mix</h4>
            
            <div style="display: flex; flex-direction: column; gap: 15px;">
                @foreach(\App\Models\Category::withCount('blogs')->get() as $category)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 15px; background: #f8fafc; border-radius: 15px; transition: 0.3s;"
                     onmouseover="this.style.background='#f1f4f9'; this.style.transform='translateX(5px)'" 
                     onmouseout="this.style.background='#f8fafc'; this.style.transform='translateX(0)'">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="width: 8px; height: 8px; background: #422afb; border-radius: 50%;"></div>
                        <span style="color: #1b254b; font-weight: 600; font-size: 14px;">{{ $category->name }}</span>
                    </div>
                    <span style="background: #fff; color: #1b254b; padding: 4px 10px; border-radius: 8px; font-size: 12px; font-weight: 700; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                        {{ $category->blogs_count }}
                    </span>
                </div>
                @endforeach
            </div>

            {{-- একটি ছোট প্রমোশনাল/হেল্প বক্স --}}
            <div style="margin-top: 30px; background: linear-gradient(135deg, #422afb, #6a56fd); border-radius: 20px; padding: 20px; color: white; text-align: center;">
                <p style="margin: 0; font-size: 13px; opacity: 0.8;">Need Help?</p>
                <h5 style="margin: 5px 0 15px; font-weight: 700;">Documentation</h5>
                <a href="#" style="background: white; color: #422afb; padding: 8px 20px; border-radius: 12px; text-decoration: none; font-size: 13px; font-weight: 700; display: inline-block;">Read Guides</a>
            </div>
        </div>

    </div>
</div>

<style>
    tbody tr {
        cursor: pointer;
    }
    tbody tr:hover {
        background: #f1f4f9 !important;
    }
</style>
@endsection