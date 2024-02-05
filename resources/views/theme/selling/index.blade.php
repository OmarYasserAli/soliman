@extends('theme.layout')
@section('layout')

    <div class="selling-area">
        <div class="container">
            <div class="selling-title">
                <h2>{{__('site.selling.avprojects')}}</h2>
                <h5>{{__('site.selling.solimansprojects')}}</h5>
            </div>

            <div class="selling-projects">
                <div class="row">
                    @foreach($sprojects as $sproject)
                        @include('theme.selling.box.project_item', ['sproject' => $sproject])
                    @endforeach
                    <span class="sprojects-co"></span>
                    <div class="col-12">
                        <div class="sp-more">
                            @if($showmore)
                                <a href="#" data-page="2" class="sp-more-btn">{{__('site.selling.spmore')}}</a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('footer')



        <script>
            $('.sp-more-btn').on('click', function (e) {
                e.preventDefault();
                if ($(this).hasClass('__stop')) {
                    return false;
                }
                var page = parseInt($(this).attr('data-page'));
                var co = $(this).text();
                $.ajax({
                    url: '{{ route('selling.projects.load') }}',
                    type: 'POST',
                    data: {
                        page: page,
                        _token: "{{csrf_token()}}"
                    },
                    beforeSend: () => {
                        $(this).addClass('__stop').text('{{__("site.selling.loading")}}')
                    },
                    error: (jqXHR, textStatus, errorThrown) => {
                        $(this).removeClass('__stop').text(co)
                    },
                    success: (data) => {
                        if (data.status) {
                            $(this).attr('data-page', data.page)
                            $('.sprojects-co').before(data.list)
                            if (data.showmore == false) {
                                $(this).remove()
                            }
                        }
                        $(this).removeClass('__stop').text(co)
                    }
                })
            })

        </script>
    @endpush

@endsection
