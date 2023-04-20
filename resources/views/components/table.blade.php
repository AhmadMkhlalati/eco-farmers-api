<div class="flex flex-col w-full z-10 overflow-y-scroll">
    <div class="overflow-x-auto">
        <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b border-gray-200">
                <table class="min-w-full divide-y divide-gray-200 z-10">
                    <thead class="bg-gray-50">
                    <tr>
                        {{$head}}
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    {{$body}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
