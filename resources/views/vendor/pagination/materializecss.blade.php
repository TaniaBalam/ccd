@if ($paginator->hasPages())


    <ul class="pagination">


        {{-- Previous Page Link --}}

        @if ($paginator->onFirstPage())
            <li class="disabled"><i class="material-icons">chevron_left</i></li>
        @else
            <li class="waves-effect"><a wire:click="previousPage"><i class="material-icons">chevron_left</i></a></li>
        @endif



        {{-- Pagination Elements --}}

        @foreach ($elements as $element)

            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled">{{ $element }}</li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" style="background:#B8860B">
                            <a class="page-link">{{ $page }}</a>
                        </li>
                    @else
                        <li class="waves-effect page-item"><a disabled class="page-link" >{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif

        @endforeach


        {{-- Next Page Link --}}
        @if ($paginator->onLastPage())
            <li class="disabled"><i class="material-icons">chevron_right</i></li>  
        @else
        <li class="waves-effect"><a wire:click="nextPage"><i class="material-icons">chevron_right</i></a></li>
        @endif
    </ul>

@endif