<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50 font-sans">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <!-- Logo & Brand Name -->
                <div class="shrink-0 flex items-center">
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 font-black text-red-800 text-lg tracking-tight">
                        @elseif(Auth::user()->role === 'faculty')
                        <a href="{{ route('faculty.dashboard') }}" class="flex items-center gap-2 font-black text-red-800 text-lg tracking-tight">
                            @elseif(Auth::user()->role === 'department_head')
                            <a href="{{ route('department.dashboard') }}" class="flex items-center gap-2 font-black text-red-800 text-lg tracking-tight">
                                @else
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-black text-red-800 text-lg tracking-tight">
                                    @endif
                                    <img src="{{ asset('images/UDM-CHS logo.png') }}" alt="UDM Logo" class="h-9 w-auto object-contain" />
                                    <span class="text-red-800">NurseCompass</span>
                                </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden space-x-1 sm:flex items-center">
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('admin.students') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.students') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Manage Student') }}
                    </a>
                    <a href="{{ route('admin.sections') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.sections') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Manage Section') }}
                    </a>
                    <a href="{{ route('admin.faculty') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.faculty') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Manage Faculty') }}
                    </a>
                    <a href="{{ route('admin.dean') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.dean') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Manage Dean') }}
                    </a>
                    @elseif(Auth::user()->role === 'faculty')
                    <a href="{{ route('faculty.dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('faculty.dashboard') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Faculty Dashboard') }}
                    </a>
                    <a href="{{ route('reviewers.index') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('reviewers.*') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Study Materials') }}
                    </a>
                    @elseif(Auth::user()->role === 'department_head')
                    <a href="{{ route('department.dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('department.dashboard') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Dept Head Dashboard') }}
                    </a>
                    <a href="{{ route('department.assessment.upload') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('department.assessment.upload') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Upload Assessment') }}
                    </a>
                    <a href="{{ route('department.assessment.history') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('department.assessment.history') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Assessment History') }}
                    </a>
                    @else
                    <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('dashboard') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Assessment Portal') }}
                    </a>
                    <a href="{{ route('reviewers.index') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('reviewers.*') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Study Materials') }}
                    </a>
                    <a href="{{ route('student.assessment-history') }}" class="px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('student.assessment-history') ? 'bg-red-50 text-red-800' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ __('Assessment History') }}
                    </a>
                    @endif
                </div>
            </div>

            <!-- Custom Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div x-data="{ dropdownOpen: false }" class="relative">
                    <!-- Trigger Button -->
                    <button @click="dropdownOpen = !dropdownOpen" class="inline-flex items-center px-3 py-2 border border-gray-200 text-sm font-semibold rounded-xl text-gray-800 bg-gray-50 hover:bg-gray-100 hover:text-gray-900 focus:outline-none transition shadow-sm">
                        <div class="w-7 h-7 rounded-full bg-red-100 text-red-800 flex items-center justify-center font-bold mr-2 text-xs">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="text-gray-800">{{ Auth::user()->name }}</span>
                        <div class="ms-2 text-gray-500">
                            <svg class="fill-current h-4 w-4 transform transition-transform duration-200" :class="{'rotate-180': dropdownOpen}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>

                    <!-- Dropdown Panel -->
                    <div x-show="dropdownOpen"
                        style="display: none;"
                        @click.away="dropdownOpen = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                        class="absolute right-0 mt-2 w-60 bg-white border-2 border-gray-200 rounded-3xl shadow-2xl overflow-hidden z-50">

                        <!-- User Info Header -->
                        <div class="px-5 py-4 border-b-2 border-gray-100 bg-gray-50/70">
                            <p class="text-[10px] text-gray-400 uppercase font-extrabold tracking-wider">Signed in as</p>
                            <p class="text-xs font-bold text-gray-900 truncate mt-0.5">{{ Auth::user()->email }}</p>
                        </div>

                        <!-- Menu Options -->
                        <div class="p-2 space-y-1">
                            <a href="{{ route('profile.edit') }}" @click="dropdownOpen = false" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-100 rounded-2xl font-semibold transition">
                                {{ __('Profile Settings') }}
                            </a>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-[#B91C1C] hover:bg-red-50 rounded-2xl font-bold transition">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger Menu Button -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-gray-200 px-4 pt-2 pb-4 space-y-1">
        @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Admin Dashboard') }}
        </a>
        <a href="{{ route('admin.students') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('admin.students') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Manage Student') }}
        </a>
        <a href="{{ route('admin.sections') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('admin.sections') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Manage Section') }}
        </a>
        <a href="{{ route('admin.faculty') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('admin.faculty') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Manage Faculty') }}
        </a>
        <a href="{{ route('admin.dean') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('admin.dean') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Manage Dean') }}
        </a>
        @elseif(Auth::user()->role === 'faculty')
        <a href="{{ route('faculty.dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('faculty.dashboard') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Faculty Dashboard') }}
        </a>
        <a href="{{ route('reviewers.index') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('reviewers.*') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Study Materials') }}
        </a>
        @elseif(Auth::user()->role === 'department_head')
        <a href="{{ route('department.dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('department.dashboard') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Dept Head Dashboard') }}
        </a>
        <a href="{{ route('department.assessment.upload') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('department.assessment.upload') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Upload Assessment') }}
        </a>
        <a href="{{ route('department.assessment.history') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('department.assessment.history') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Assessment History') }}
        </a>
        @else
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('dashboard') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Assessment Portal') }}
        </a>
        <a href="{{ route('reviewers.index') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('reviewers.*') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Study Materials') }}
        </a>
        <a href="{{ route('student.assessment-history') }}" class="block px-3 py-2 rounded-lg text-base font-semibold {{ request()->routeIs('student.assessment-history') ? 'bg-red-50 text-red-800' : 'text-gray-800 hover:bg-gray-50' }}">
            {{ __('Assessment History') }}
        </a>
        @endif

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 mt-3">
            <div class="px-2 mb-2">
                <div class="font-extrabold text-gray-900 text-sm">{{ Auth::user()->name }}</div>
                <div class="text-xs font-medium text-gray-500 truncate">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-50">
                    {{ __('Profile Settings') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-base font-medium text-red-600 hover:bg-red-50">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>