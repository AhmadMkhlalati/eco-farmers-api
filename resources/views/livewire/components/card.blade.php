
<div class="shadow-lg px-4 py-6 w-full bg-white dark:bg-gray-800 relative">
    <p class="text-sm w-max text-gray-700 dark:text-white font-semibold border-b border-gray-200">
        Total Tasks
{{--        {{(new App\Services\Dashboard\PercentageService(Task::class))->getYesterdayDifference()}}--}}
{{--        {{ $tasksService->getYesterdayDifference() }}--}}
    </p>
    <div class="flex items-end space-x-2 my-6">
        <p class="text-5xl text-black dark:text-white font-bold">
            {{$tasks->count()}}
        </p>
        <span class="text-green-500 text-xl font-bold flex items-center">
            <svg width="20" fill="currentColor" height="20" class="h-3" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                <path d="M1675 971q0 51-37 90l-75 75q-38 38-91 38-54 0-90-38l-294-293v704q0 52-37.5 84.5t-90.5 32.5h-128q-53 0-90.5-32.5t-37.5-84.5v-704l-294 293q-36 38-90 38t-90-38l-75-75q-38-38-38-90 0-53 38-91l651-651q35-37 90-37 54 0 91 37l651 651q37 39 37 91z">
                </path>
            </svg>
            {{($tasks->count() / 100) * 100}}%
        </span>
    </div>
    <div class="dark:text-white">
        <div class="flex items-center pb-2 mb-2 text-sm space-x-12 md:space-x-24 justify-between border-b border-gray-200">
            <p>
                Today Tasks
            </p>
            <div class="flex items-end text-xs">
                {{( $tasks->whereBetween('created_at', [Carbon\Carbon::now()->startOfDay(), Carbon\Carbon::now()->endOfDay()]))->count() }}
                <span class="flex items-center">
                    <svg width="20" fill="currentColor" height="20" class="h-3 text-green-500" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1675 971q0 51-37 90l-75 75q-38 38-91 38-54 0-90-38l-294-293v704q0 52-37.5 84.5t-90.5 32.5h-128q-53 0-90.5-32.5t-37.5-84.5v-704l-294 293q-36 38-90 38t-90-38l-75-75q-38-38-38-90 0-53 38-91l651-651q35-37 90-37 54 0 91 37l651 651q37 39 37 91z">
                        </path>
                    </svg>
                    {{(($tasks->whereBetween('created_at', [Carbon\Carbon::now()->startOfDay(), Carbon\Carbon::now()->endOfDay()]))->count() / 100) * 100 }} %
                </span>
            </div>
        </div>
        <div class="flex items-center mb-2 pb-2 text-sm space-x-12 md:space-x-24 justify-between border-b border-gray-200">
            <p>
                Last 7 Days
            </p>
            <div class="flex items-end text-xs">
                {{( $tasks->whereBetween('created_at', [Carbon\Carbon::now()->subDays(7)->startOfDay(), Carbon\Carbon::now()->endOfDay()]))->count() }}
                <span class="flex items-center">
                    <svg width="20" fill="currentColor" height="20" class="h-3 text-green-500" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1675 971q0 51-37 90l-75 75q-38 38-91 38-54 0-90-38l-294-293v704q0 52-37.5 84.5t-90.5 32.5h-128q-53 0-90.5-32.5t-37.5-84.5v-704l-294 293q-36 38-90 38t-90-38l-75-75q-38-38-38-90 0-53 38-91l651-651q35-37 90-37 54 0 91 37l651 651q37 39 37 91z">
                        </path>
                    </svg>
                    {{ ((($tasks->whereBetween('created_at', [Carbon\Carbon::now()->startOfDay(), Carbon\Carbon::now()->endOfDay()]))->count() / 100) - ($tasks->whereBetween('created_at', [Carbon\Carbon::now()->subDays(7)->startOfDay(), Carbon\Carbon::now()->endOfDay()]))->count() / 100) * 100 }} %
                </span>
            </div>
        </div>
        <div class="flex items-center text-sm space-x-12 md:space-x-24 justify-between">
            <p>
                New visitor
            </p>
            <div class="flex items-end text-xs">
                45
                <span class="flex items-center">
                    <svg width="20" fill="currentColor" height="20" class="h-3 text-green-500" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1675 971q0 51-37 90l-75 75q-38 38-91 38-54 0-90-38l-294-293v704q0 52-37.5 84.5t-90.5 32.5h-128q-53 0-90.5-32.5t-37.5-84.5v-704l-294 293q-36 38-90 38t-90-38l-75-75q-38-38-38-90 0-53 38-91l651-651q35-37 90-37 54 0 91 37l651 651q37 39 37 91z">
                        </path>
                    </svg>
                    41%
                </span>
            </div>
        </div>
    </div>
</div>
