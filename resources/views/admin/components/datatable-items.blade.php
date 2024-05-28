<div class="flex items-center">
    {{ $columnName }}
    @if ($sortColumn !== $columnName)
        <x-heroicon-s-chevron-up-down class="bi bi-chevron-up" style="width: 20; height: auto;" />
    @elseif($sortDirection === 'ASC')
        <x-heroicon-s-chevron-down class="bi bi-chevron-up" style="width: 20; height: auto;" />
    @else
        <x-heroicon-s-chevron-up class="bi bi-chevron-up" style="width: 20; height: auto;" />
    @endif

</div>
