@switch($richText['nodeType'])
    @case('paragraph')
    @case('heading-1')

    @case('heading-2')
    @case('heading-3')

    @case('heading-4')
    @case('heading-5')

    @case('heading-6')
        @php
            $tag = $richText['nodeType'] === 'paragraph' ? 'p' : 'h' . (int) substr($richText['nodeType'], -1);
        @endphp

        <{{ $tag }}>
            @foreach ($richText['content'] as $text)
                @if (empty($text['value']))
                    <br>
                @else
                    @php
                        $formattedText = $text['value'];
                        foreach ($text['marks'] as $mark) {
                            switch ($mark['type']) {
                                case 'bold':
                                    $formattedText = '<strong>' . $formattedText . '</strong>';
                                    break;
                                case 'italic':
                                    $formattedText = '<em>' . $formattedText . '</em>';
                                    break;
                                case 'underline':
                                    $formattedText = '<u>' . $formattedText . '</u>';
                                    break;
                                case 'superscript':
                                    $formattedText = '<sup>' . $formattedText . '</sup>';
                                    break;
                                case 'subscript':
                                    $formattedText = '<sub>' . $formattedText . '</sub>';
                                    break;
                                case 'code':
                                    $formattedText = '<code>' . $formattedText . '</code>';
                                    break;
                            }
                        }
                    @endphp
                    {!! $formattedText !!}
                @endif
            @endforeach
            </{{ $tag }}>
        @break

        @case('hr')
            <hr class="h-px my-2 bg-gray-400 border-0">
        @break

        @case('unordered-list')
            <ul class="list-disc pl-5">
                @foreach ($richText['content'] as $listItem)
                    <li>
                        @foreach ($listItem['content'] as $paragraph)
                            @foreach ($paragraph['content'] as $text)
                                {!! $text['value'] !!}
                            @endforeach
                        @endforeach
                    </li>
                @endforeach
            </ul>
        @break

        @case('ordered-list')
            <ol class="list-decimal pl-5">
                @foreach ($richText['content'] as $listItem)
                    <li>
                        @foreach ($listItem['content'] as $paragraph)
                            @foreach ($paragraph['content'] as $text)
                                {!! $text['value'] !!}
                            @endforeach
                        @endforeach
                    </li>
                @endforeach
            </ol>
        @break

        @case('blockquote')
            <blockquote class="p-4 my-4 border-s-8 border-gray-300 bg-gray-50 dark:border-gray-500 dark:bg-gray-800">
                @foreach ($richText['content'] as $paragraph)
                    @foreach ($paragraph['content'] as $text)
                        {!! $text['value'] !!}
                    @endforeach
                @endforeach
            </blockquote>
        @break

        {{-- the end of case for text  --}}
        {{-- the next case is for asset  --}}
        @case('embedded-asset-block')
            {{-- Handle embedded asset block --}}
            @foreach ($rawData['includes']['Asset'] as $asset)
                @if ($asset['sys']['id'] === $richText['data']['target']['sys']['id'])
                    <div class="flex justify-center px-16">
                        <img src="https:{{ $asset['fields']['file']['url'] }}" class="aspect-video"
                            alt="{{ $asset['fields']['title'] }}">
                    </div>
                @endif
            @endforeach
        @break

        @case('table')
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg m-5">
                <table class="w-full">
                    @foreach ($richText['content'] as $row)
                        <tr>
                            @foreach ($row['content'] as $cell)
                                <{{ $row['nodeType'] === 'table-header-cell' ? 'th' : 'td' }} class="border-2 border-gray-500">
                                    @foreach ($cell['content'] as $paragraph)
                                        @foreach ($paragraph['content'] as $text)
                                            {!! $text['value'] !!}
                                        @endforeach
                                    @endforeach
                                    </{{ $row['nodeType'] === 'table-header-cell' ? 'th' : 'td' }}>
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>
        @break

        @default
            <strong>richText ini TIDAK TERENDER</strong> <br>
    @endswitch


    {{-- ini beberapa case yang belum terdaftar
    paragraph->hyperlink --}}
