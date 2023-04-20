<div class="mt-4">
    @foreach($items as $item)
        @livewire('components.sidebar-item',
        [
        'title' => $item['title'],
        'icon' => $item['icon'],
        'items' => $item['items'],
        'route' => $item['route']
        ],key($item['title']))
    @endforeach

</div>
