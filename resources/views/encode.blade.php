<!--如果在页面其他位置引入过jquery，此处引用可以删除-->
<script src="{{ asset('vendor/markdown/js/jquery.min.js') }}"></script>

<link rel="stylesheet" href="{{ asset('vendor/markdown/css/editormd.css') }}" />
<script src="{{ asset('vendor/markdown/js/editormd.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        @foreach($editors as $editor)
            editormd("{{ $editor }}", {
                width : "100%",
                height : 640,
                imageFormats : ["JPG", "JPEG", "GIF", "PNG", "jpg", "jpeg", "gif", "png"],
                imageUpload : true,
                imageUploadURL : "{{ route('markdown.upload') }}",
                lineNumbers : false,
                syncScrolling : "single",
                path : "{{ asset('vendor/markdown/lib') }}/",
                placeholder : "请使用 Markdown 语法",
                styleActiveLine : false,
                toolbarIcons : function () {
                    return ["h2", "h3", "h4", "quote", "|", "list-ul", "list-ol", "|", "link", "image", "code-block", "table", "|", "watch", "fullscreen", "help"]
                },

            });
        @endforeach
    });
</script>
