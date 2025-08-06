<i style="cursor: move;" data-feather="move" class="icon-sm handle me-2"></i>

<script>

    @if(request('trash') != "true")
    $( document ).ready(function() {

        var simpleList = document.querySelector("#body_container_item");
        new Sortable(simpleList, {
            handle: '.handle', // handle's class
            animation: 150,
            ghostClass: 'bg-light',
            onEnd: function (/**Event*/evt) {
                var itemEl = evt.item;  // dragged HTMLElement
                evt.to;    // target list
                evt.from;  // previous list
                evt.oldIndex;  // element's old index within old parent
                evt.newIndex;  // element's new index within new parent
                evt.oldDraggableIndex; // element's old index within old parent, only counting draggable elements
                evt.newDraggableIndex; // element's new index within new parent, only counting draggable elements
                evt.clone // the clone element
                evt.pullMode;  // when item is in another sortable: `"clone"` if cloning, `true` if moving


                const old_id = $('#tr_container_index_' + evt.oldIndex).attr('data-id')

                const new_id = $('#tr_container_index_' + evt.newIndex).attr('data-id')

                const new_ids = Array.from(simpleList.querySelectorAll('tr')).map((row) => {
                    return row.getAttribute('data-id');
                });

                callAjax(
                    "PUT",
                    "{{route('administrator.'.$prefixView.'.sort')}}",
                    {
                        'old_id': new_ids,
                        'new_id': new_ids,
                    },
                    (response) => {

                    },
                    (error) => {

                    },
                    false,
                )

            },

        });
    });

    @endif

</script>
