@extends('adminlte::page')

@push('css')
    <style>
        .anoucement-main {
            width: 100%;
            height: 100%;
            padding-right: 26px;
            background: #F8F7FA;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 26px;
            display: inline-flex;
        }

        .anoucement {
            width: 100%;
            height: 820px;
            padding-bottom: 10px;
            background: transparent;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            display: inline-flex;
        }

        .anoucement-header {
            align-self: stretch;
            height: 628px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 16px;
            display: flex;
        }

        .anoucement-header .header {
            align-self: stretch;
            justify-content: flex-start;
            align-items: flex-start;
            display: inline-flex
        }

        .header-main {
            justify-content: flex-start;
            align-items: center;
            gap: 800px;
            display: flex;
        }

        .header-title {
            color: #2B2B2B;
            font-size: 24px;
            font-family: Pretendard;
            font-weight: 700;
            word-wrap: break-word
        }

        .header-button-main {
            height: 38px;
            background: white;
            border-radius: 6px;
            border: 1px #EC661A solid;
            justify-content: center;
            align-items: center;
            display: flex
        }

        .header-button-main div {
            flex: 1 1 0;
            height: 38px;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 10px;
            padding-bottom: 10px;
            justify-content: center;
            align-items: center;
            gap: 12px;
            display: flex
        }

        .header-button-main .button {
            color: #EC661A;
            font-size: 16px;
            font-family: Pretendard;
            font-weight: 500;
            line-height: 18px;
            word-wrap: break-word
        }

        .custom-container {
            align-self: stretch;
            height: 583px;
            background: white;
            box-shadow: 0px 4px 18px rgba(75, 70, 92, 0.10);
            border-radius: 6px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            display: flex;
        }

        .header-container {
            align-self: stretch;
            padding-top: 24px;
            padding-bottom: 24px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 16px;
            display: flex;
        }

        .title-container {
            align-self: stretch;
            padding-left: 24px;
            padding-right: 24px;
            justify-content: flex-start;
            align-items: center;
            display: inline-flex;
        }

        .label {
            font-size: 16px;
            font-family: Pretendard;
            word-wrap: break-word;
        }

        .important-label {
            color: #EC661A;
            font-weight: 700;
        }

        .info-container {
            flex: 1 1 0;
            height: 19px;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            display: flex;
        }

        .info-text {
            color: #2B2B2B;
            font-size: 16px;
            font-family: Pretendard;
            font-weight: 500;
            word-wrap: break-word;
        }

        .author-date-container {
            justify-content: flex-start;
            align-items: center;
            gap: 20px;
            display: flex;
        }

        .author,
        .date {
            color: #4D4D4D;
            font-size: 16px;
            font-family: Pretendard;
            font-weight: 400;
            word-wrap: break-word;
        }

        .content-container {
            align-self: stretch;
            height: 438px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            display: flex;
        }

        .update-info-container {
            align-self: stretch;
            height: 438px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 10px;
            display: flex;
        }

        .update-text {
            padding: 20px 24px 0;
            align-self: stretch;
            height: 438px;
            border-top: 1px #DBDADE solid;
            border-bottom: 1px #DBDADE solid;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            display: flex;
            gap: 10px;
            line-height: 19.2px;
        }

        .content-text {
            color: #2B2B2B;
            font-size: 16px;
            font-family: Pretendard;
            font-weight: 400;
            word-wrap: break-word;
            word-spacing: 5px;
            line-height: 29.5px;
            margin-bottom: 10px;
            overflow-y: auto;
        }

        .navigation-container {
            align-self: stretch;
            height: 86px;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            display: flex;
        }

        .prev-post,
        .next-post {
            align-self: stretch;
            padding-left: 24px;
            padding-right: 24px;
            padding-top: 12px;
            padding-bottom: 12px;
            background: #FAFAFA;
            justify-content: flex-start;
            align-items: center;
            display: inline-flex;
            border-bottom: 1px #DBDADE solid;
        }

        .text {
            margin-left: 10px;
            color: #595959;
            font-size: 16px;
            font-family: Pretendard;
            font-weight: 500;
            word-wrap: break-word;
        }

        .label {
            opacity: 0.80;
            color: #EC661A;
            font-size: 16px;
            font-family: Pretendard;
            font-weight: 500;
            word-wrap: break-word;
        }

        .info-text {
            margin-left: 10px;
        }

        .attach-photo {
            gap: 10px;
            border: none;
            outline: none;
            padding: 10px 12px;
            border-radius: 5px;
            margin: 10px 25px;
            align-self: stretch;
            background: #F5F5F5;
            justify-content: flex-start;
            align-items: center;
            display: inline-flex;
            border-bottom: 1px #f5f5f5 solid;
            max-width: 400px;
        }

        .attach-photo span {
            color: #4D4D4D;
        }
    </style>
@endpush
@section('title', __('bulletin::msg.announcement'))

@section('content')
    <div class="anoucement-main">
        <div class="anoucement">
            <div class="anoucement-header">
                <div class="header d-flex justify-content-between align-items-center">
                    <div class="header-title text-nowrap">{{ trans('bulletin::msg.announcement') }}</div>
                    <div class="header-button-main cursor-pointer">
                        <div>
                            <a href="{{ url('/admin/manage-bulletin') }}"
                                class="button text-nowrap">{{ trans('bulletin::msg.list-button') }}</a>
                        </div>
                    </div>
                </div>

                <div class="custom-container">
                    <div class="header-container">
                        <div class="title-container">
                            <div class="label important-label"> {{ trans('bulletin::msg.' . $post->distinguish) }} </div>
                            <div class="info-container">
                                <div class="info-text"> {{ $post->title }} </div>
                                <div class="author-date-container">
                                    <?php
                                    $dateString = $post->created_at;
                                    $originalDate = new DateTime($dateString);
                                    $registeredDate = $originalDate->format(setting('date_format_php', 'Y-m-d'));
                                    $formattedDate = str_replace('-', '.', $registeredDate);
                                    ?>
                                    <div class="author">{{ trans('bulletin::msg.author') }} :
                                        {{ $post->author ? $post->author->first_name : 'N/A' }}</div>
                                    <div class="date">{{ trans('bulletin::msg.register-date') }}: {{ $formattedDate }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-container">
                        <div class="update-info-container">
                            <div class="update-text">
                                <span class="content-text">
                                    {!! $post->content !!}
                                </span>
                            </div>
                        </div>

                        @if (!is_null($post->firstMedia('attachment')))
                            <button class="attach-photo"
                                onclick="openContractModal('{{ $post->firstMedia('attachment')?->basename }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-paperclip"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" />
                                </svg> <span>
                                    {{ $post->firstMedia('attachment')?->basename }}
                                </span>
                            </button>
                        @endif
                        <div class="navigation-container">
                            @if (!is_null($previousPost))
                                <a class="prev-post" href="{{ url('admin/manage-bulletin/show/' . $previousPost->id) }}">
                                    <div class="label">{{ trans('bulletin::msg.previous') }}</div>
                                    <div class="text">{{ $previousPost->title }}</div>
                                </a>
                            @endif
                            @if (!is_null($nextPost))
                                <a class="next-post" href="{{ url('admin/manage-bulletin/show/' . $nextPost->id) }}">
                                    <div class="label">{{ trans('bulletin::msg.next') }}</div>
                                    <div class="text">{{ $nextPost->title }}</div>
                                </a>
                            @endif

                            @if (is_null($previousPost) && is_null($nextPost))
                                <div class="no-posts">
                                    <div class="text">{{ trans('bulletin::msg.no-posts-available') }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------Show Image modal------------------------------------------------------>
    <div class="modal fade pdf-modal-img" id="imageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" alt="Image" class="w-100 h-100">
                    <div id="showContract"></div>
                </div>
            </div>
        </div>
    </div>
    <!-------------------------------------Show Image modal------------------------------------------------------>

@stop

@section('css')

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.12/pdfobject.min.js" integrity="sha512-lDL6DD6x4foKuSTkRUKIMQJAoisDeojVPXknggl4fZWMr2/M/hMiKLs6sqUvxP/T2zXdrDMbLJ0/ru8QSZrnoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function openContractModal(basename) {
            let url = '{{ route('media.file.display', ':file') }}';
            url = url.replace(':file', basename);
            $.ajax({
                url: url,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(result, status, xhr) {
                    let contentType = xhr.getResponseHeader('Content-Type');
                    let blob = new Blob([result], {
                        type: contentType
                    });
                    let fileExtension = contentType.split('/')[1];
                    if (fileExtension === 'pdf' || fileExtension === 'doc' || fileExtension === 'docx' ||
                        fileExtension === 'xls' || fileExtension === 'xlsx') {
                        initiateDownload(blob, fileExtension);
                    } else {
                        showImagePreview(blob);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }

        function showImagePreview(blob) {
            let embedURL = URL.createObjectURL(blob);
            $('#imageModal .modal-body img').attr('src', embedURL).show();
            $('#imageModal .modal-body object').hide();
            $('#showContract').hide();
            $('#imageModal .modal-footer').show();
            $('#imageModal').modal('show');
        }

        function initiateDownload(blob, fileExtension) {
            let downloadLink = document.createElement('a');
            downloadLink.href = URL.createObjectURL(blob);
            downloadLink.download = 'file.' + fileExtension;
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        }
    </script>

@stop
