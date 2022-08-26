<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

    <div class="w-full sm:max-w-md ">
        <a href="/" class="flex items-end">
            <x-application-logo class="h-[6rem] mr-3" />
            <div id="site-slogan" class="text-[#2c3690] text-[20px] font-bold uppercase">UCC School of Graduate Studies
                Supervisor Thesis Management Portal</div>
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>