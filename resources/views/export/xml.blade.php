{!! $xml_header !!}
<root>
    @foreach($notes as $n)
        <note>
            <title>{!! $n->title !!}</title>
            <text><![CDATA[{!! $n->text !!}]]></text>
        </note>
    @endforeach
</root>