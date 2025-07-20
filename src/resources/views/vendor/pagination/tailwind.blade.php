@if ($paginator->hasPages())
    <nav role="navigation" class="flex justify-center mt-6">
        <ul class="inline-flex items-center space-x-2">
            {{-- 前へリンク --}}
            @if ($paginator->onFirstPage())
                <li class="text-gray-400">&lt;</li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="text-blue-500 hover:underline">&lt;</a>
                </li>
            @endif

            {{-- ページ番号 --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="text-gray-500">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="font-bold text-blue-700">{{ $page }}</li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="text-blue-500 hover:underline">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- 次へリンク --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="text-blue-500 hover:underline">&gt;</a>
                </li>
            @else
                <li class="text-gray-400">&gt;</li>
            @endif
        </ul>
    </nav>
@endif
