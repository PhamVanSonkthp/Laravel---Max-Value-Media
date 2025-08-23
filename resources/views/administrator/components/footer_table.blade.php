<div style="overflow: hidden;">
    @if(isset($items))
        @if(empty($items->count()))
            <div class="text-center" style="padding: 20px;">
                No data
            </div>
        @else
            <div style="padding-top: 10px;">
                {{ $items->links('pagination::bootstrap-4') }}
            </div>

        @endif
    @endif
</div>

