<div class="">
    <div class="w-full ">
        <div class=" rounded-lg px-4 py-5 mb-2 sm:px-6 w-full flex justify-between items-center dark:bg-dark-eval-1 ">
            <div>
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <h2 class="text-xl font-semibold leading-tight">
                        {{ $title ?? ''  }}
                    </h2>

                </div>
                <p class="mt-0 max-w-2xl text-sm text-gray-500 dark:text-gray-400">
                    {{$subtitle ?? ''}}
                </p>
            </div>
            <div class="flex flex-row space-x-3">
                {{$perPageContainer ?? ''}}
                {{ $actions ?? '' }}
            </div>
        </div>
        <div class=" rounded-lg  border-gray-200 dark:text-gray-400 dark:bg-dark-eval-3  px-4 py-5 h-full">
            {{$body}}
        </div>
    </div>
</div>
