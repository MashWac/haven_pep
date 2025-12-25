@extends('layouts.admin')
@section('content')
<main class="flex-1 flex flex-col h-full relative overflow-y-auto bg-background-light dark:bg-background-dark">
    <form action="{{url('admin_settings/update')}}" method="post">
        @method('PUT')
        @csrf
        <div class="layout-container flex flex-col w-full max-w-[1200px] mx-auto px-6 py-8">
            <div class="flex flex-wrap gap-2 mb-6 items-center">
                <a class="text-[#877b64] hover:text-[#DA70D6] text-sm font-medium leading-normal transition-colors" href="#">Home</a>
                <span class="material-symbols-outlined text-[#877b64] text-sm">chevron_right</span>
                <span class="text-[#171511] dark:text-white text-sm font-medium leading-normal">Settings</span>
            </div>
            <div class="flex flex-wrap justify-between items-end gap-4 mb-8 sticky top-0 bg-background-light dark:bg-background-dark z-20 py-2 border-b border-transparent">
                <div class="flex flex-col gap-2">
                    <h1 class="text-[#171511] dark:text-white text-3xl font-black leading-tight tracking-tight">System Settings</h1>
                    <p class="text-[#877b64] text-base font-normal">Manage global configurations, site metadata, and platform preferences.</p>
                </div>
                <div class="flex gap-3">
                    <button class="flex items-center justify-center px-4 h-10 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#2c261a] dark:border-[#362f22] dark:text-white text-[#171511] text-sm font-medium hover:bg-gray-50 dark:hover:bg-[#362f22]/80 transition-colors">
                        Cancel
                    </button>
                    <button class="flex items-center justify-center px-4 h-10 rounded-lg bg-[#DA70D6] text-white text-sm font-bold shadow-md hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined text-[20px] mr-2">save</span>
                        Save All Settings
                    </button>
                </div>
            </div>
            <div class="flex items-start gap-3 p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-900/30">
                <span class="material-symbols-outlined text-blue-500 shrink-0">info</span>
                <div class="flex flex-col gap-1">
                    <p class="text-sm font-bold text-blue-900 dark:text-blue-100">System Configuration Note</p>
                    <p class="text-xs text-blue-700 dark:text-blue-300">Changing the "Maintenance Mode" setting will immediately affect all users currently logged into the platform. Please proceed with caution.</p>
                </div>
            </div>
            <div class="flex flex-col gap-6 pb-12">
                <div class="bg-white dark:bg-[#2c261a] rounded-xl shadow-sm border border-[#e5e2dc]/50 dark:border-[#362f22] overflow-hidden">
                    <div class="hidden md:grid grid-cols-12 gap-6 p-4 border-b border-[#e5e2dc] dark:border-[#362f22] bg-primary/20 dark:bg-[#362f22]/50">
                        <div class="col-span-4 text-xs font-bold uppercase tracking-wider text-[#877b64]">Setting Name</div>
                        <div class="col-span-6 text-xs font-bold uppercase tracking-wider text-[#877b64]">Value</div>
                        <div class="col-span-2 text-xs font-bold uppercase tracking-wider text-[#877b64]">Type</div>
                    </div>
                    @foreach($system_settings as $setting)
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-6 p-6 border-b border-[#e5e2dc] dark:border-[#362f22] items-start md:items-center hover:bg-gray-50 dark:hover:bg-[#362f22]/30 transition-colors">
                        <div class="md:col-span-4 flex flex-col">
                            <label class="text-[#171511] dark:text-white font-bold text-sm">{{$setting->setting_name}}</label>
                            <span class="text-[#877b64] text-xs mt-1">Used in the header and system emails.</span>
                        </div>
                        @if($setting->setting_type=='image')
                        <div class="md:col-span-6 flex items-center gap-4">
                            <div class="bg-center bg-no-repeat bg-cover rounded-lg size-12 border border-[#e5e2dc] dark:border-[#4a402e] shrink-0" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBXnDqPDjRc4zgEWm3ooskMsxiAn92iMWMJSiKvfJO0NuMOVo2gRWa4WnMcKQWIF8HfBdK7csA9M0AWSilxOS9R4OKvn1ec_gHDWcs8Be8P1zd8hdV3EUocJBLqnGLZoHyUiBWS0utkHo-EcFzY4iiYLY32K3twT37uCofyhIwgc0zBSI8HbbjiZVzF-WtQzG3DUph3xepHIMolTaYForkmS3e9RKJNQ-K2leC4q3DPhdTg6JHq5KcoMF15o3t7zjhbAm0Fgbr3qNU");'></div>
                            <div class="flex-1">
                                <label class="flex items-center gap-2 px-3 py-2 rounded-lg border border-[#e5e2dc] bg-white dark:bg-[#362f22] dark:border-[#4a402e] cursor-pointer hover:border-[#DA70D6] dark:hover:border-[#DA70D6] group transition-colors w-fit">
                                    <span class="material-symbols-outlined text-[#877b64] group-hover:text-[#DA70D6] text-[20px]">upload</span>
                                    <span class="text-sm text-[#171511] dark:text-white">Change Logo</span>
                                    <input class="hidden" type="file" name="settings[{{ $setting->id }}]" value="{{$setting->setting_value}}" />
                                </label>
                            </div>
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-[#DA70D6] rounded-full"></span>
                                Image
                            </span>
                        </div>
                        @else
                        <div class="md:col-span-6">
                            <input name="settings[{{ $setting->id }}]" class="form-input w-full rounded-lg border border-[#e5e2dc] bg-background-light dark:bg-[#362f22] dark:border-[#4a402e] dark:text-white h-10 px-3 text-sm focus:ring-2 focus:ring-[#DA70D6]/20 focus:border-[#DA70D6] outline-none transition-all placeholder:text-[#877b64]" type="text" value="{{$setting->setting_value}}" />
                        </div>
                        <div class="md:col-span-2 flex items-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-[#40B5AD] rounded-full"></span>
                                String
                            </span>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </form>

</main>
@endsection()
@section('scripts')
@endsection