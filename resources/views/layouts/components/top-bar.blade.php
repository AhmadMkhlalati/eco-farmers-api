<!-- BEGIN: Top Bar -->
<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <div class="mr-5 menu-toggle" >
        <i data-feather="arrow-left" class="arrow-menu cursor-pointer"></i>
    </div>

    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
{{--            <li class="breadcrumb-item active" aria-current="page">{{$name}}</li>--}}
        </ol>
    </nav>
    <!-- END: Breadcrumb -->
    <div class="px-5">
    <a href="" class="cursor-pointer  ">
{{--        @if($dark_mode)--}}
{{--            <i data-feather="sun"></i>--}}

{{--        @else--}}
{{--            <i data-feather="moon"></i>--}}
{{--        @endif--}}
    </a>
    </div>
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">

        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">

            <img alt="Rubick Tailwind HTML Admin Template" src="">
        </div>


        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-primary text-white">
                <li class="p-2">
                    <div class="font-medium">{{auth()->user()->name}}</div>
                </li>
                <li><hr class="dropdown-divider border-white/[0.08]"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item hover:bg-white/5">
                            <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                        </button>
                    </form>

                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->
