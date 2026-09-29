<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Logo & Brand Name -->
                <div class="shrink-0 flex items-center">
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 font-black text-slate-900 text-lg tracking-tight">
                        @elseif(Auth::user()->role === 'faculty')
                        <a href="{{ route('faculty.dashboard') }}" class="flex items-center gap-2 font-black text-slate-900 text-lg tracking-tight">
                            @elseif(Auth::user()->role === 'department_head')
                            <a href="{{ route('department.dashboard') }}" class="flex items-center gap-2 font-black text-slate-900 text-lg tracking-tight">
                                @else
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-black text-slate-900 text-lg tracking-tight">
                                    @endif
                                    <div class="w-9 h-9 rounded-xl bg-teal-600 flex items-center justify-center text-white font-bold shadow-md shadow-teal-600/20">
                                        NC
                                    </div>
                                    <span class="text-slate-900">Nurse<span class="text-teal-600">Compass</span></span>
                                </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden space-x-1 sm:flex items-center">
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('admin.students') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.students') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ __('Manage Student') }}
                    </a>
                    <a href="{{ route('admin.sections') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.sections') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ __('Manage Section') }}
                    </a>
                    <a href="{{ route('admin.faculty') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.faculty') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ __('Manage Faculty') }}
                    </a>
                    <a href="{{ route('admin.dean') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.dean') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ __('Manage Dean') }}
                    </a>
                    @elseif(Auth::user()->role === 'faculty')
                    <a href="{{ route('faculty.dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('faculty.dashboard') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ __('Faculty Dashboard') }}
                    </a>
                    <a href="{{ route('reviewers.index') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('reviewers.*') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ __('Study Materials') }}
                    </a>
                    @elseif(Auth::user()->role === 'department_head')
                    <a href="{{ route('department.dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('department.dashboard') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ __('Dept Head Dashboard') }}
                    </a>
                    @else
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ __('Assessment Portal') }}
                    </a>
                    <a href="{{ route('reviewers.index') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('reviewers.*') ? 'bg-teal-50 text-teal-700' : 'text-slate-700 hover:text-slate-900 hover:bg-slate-50' }}">
                        {{ __('Study Materials') }}
                    </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-slate-200 text-sm font-semibold rounded-xl text-slate-800 bg-slate-50 hover:bg-slate-100 hover:text-slate-900 focus:outline-none transition shadow-sm">
                            <div class="w-7 h-7 rounded-full bg-teal-100 text-teal-800 flex items-center justify-center font-bold mr-2 text-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="text-slate-800">{{ Auth::user()->name }}</span>
                            <div class="ms-2 text-slate-500">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-slate-100 bg-white">
                            <p class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider">Signed in as</p>
                            <p class="text-xs font-bold text-slate-900 truncate mt-0.5">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="bg-white py-1">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 font-semibold transition">
                                {{ __('Profile Settings') }}
                            </a>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 font-semibold transition">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu Button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-slate-200 px-4 pt-2 pb-4 space-y-1">
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-teal-50 text-teal-700' : 'text-slate-800 hover:bg-slate-50' }}">
            {{ __('Admin Dashboard') }}
        </a>
        <a href="{{ route('admin.students') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('admin.students') ? 'bg-teal-50 text-teal-700' : 'text-slate-800 hover:bg-slate-50' }}">
            {{ __('Manage Student') }}
        </a>
        <a href="{{ route('admin.sections') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('admin.sections') ? 'bg-teal-50 text-teal-700' : 'text-slate-800 hover:bg-slate-50' }}">
            {{ __('Manage Section') }}
        </a>
        <a href="{{ route('admin.faculty') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('admin.faculty') ? 'bg-teal-50 text-teal-700' : 'text-slate-800 hover:bg-slate-50' }}">
            {{ __('Manage Faculty') }}
        </a>
        <a href="{{ route('admin.dean') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('admin.dean') ? 'bg-teal-50 text-teal-700' : 'text-slate-800 hover:bg-slate-50' }}">
            {{ __('Manage Dean') }}
        </a>
        @elseif(Auth::user()->role === 'faculty')
        <a href="{{ route('faculty.dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('faculty.dashboard') ? 'bg-teal-50 text-teal-700' : 'text-slate-800 hover:bg-slate-50' }}">
            {{ __('Faculty Dashboard') }}
        </a>
        <a href="{{ route('reviewers.index') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('reviewers.*') ? 'bg-teal-50 text-teal-700' : 'text-slate-800 hover:bg-slate-50' }}">
            {{ __('Study Materials') }}
        </a>
        @elseif(Auth::user()->role === 'department_head')
        <a href="{{ route('department.dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('department.dashboard') ? 'bg-teal-50 text-teal-700' : 'text-slate-800 hover:bg-slate-50' }}">
            {{ __('Dept Head Dashboard') }}
        </a>
        @else
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-700' : 'text-slate-800 hover:bg-slate-50' }}">
            {{ __('Assessment Portal') }}
        </a>
        <a href="{{ route('reviewers.index') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('reviewers.*') ? 'bg-teal-50 text-teal-700' : 'text-slate-800 hover:bg-slate-50' }}">
            {{ __('Study Materials') }}
        </a>
        @endif

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-200 mt-3">
            <div class="px-2 mb-2">
                <div class="font-extrabold text-slate-900 text-sm">{{ Auth::user()->name }}</div>
                <div class="text-xs font-medium text-slate-500 truncate">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50">
                    {{ __('Profile Settings') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-base font-medium text-rose-600 hover:bg-rose-50">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>