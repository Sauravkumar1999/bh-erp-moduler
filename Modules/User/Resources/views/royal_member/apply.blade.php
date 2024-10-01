@extends('adminlte::page')
@section('title', trans('user::royal-member.apply-royal-member'))
@section('content_header')
    <x-core-content-header :title="__('user::royal-member.apply-royal-member')" :breadcrumbs="$breadcrumbs" />
@stop
@section('css')
    <style>
        .border-label-light tr {
            border-color: #ffffff !important;
        }

        .table-bordered> :not(caption)>*,
        .table-bordered> :not(caption)>*>* {
            border-width: 2px !important;
        }

        .table tbody tr td,
        .table tbody tr th {
            background-color: #d9d9d9;
            text-align: left;
            vertical-align: top;
        }

        td{
            padding: 0.55rem 0.50rem !important;
        }
        .table .title {
            width: 180px;
        }


        ol {
            list-style-type: decimal;
        }

        .card-header {
            padding-bottom: 0px !important;
        }
        .form-input{
            max-width: 310px !important;
            width: 100% !important;
        }
        .form-input p{
            text-align: center;
            margin-bottom: 0;
            margin-top: 10px;
        }

        .term_txt p{
            text-align: center;
            margin-top: 10px;
        }

        @media screen and (max-width: 400px) {
            #form .apply{
                padding: 10px !important;
            }
        }

        @media screen and (max-width: 350px) {
            #form .apply{
                padding: 10px 5px !important;
            }
        }

    </style>
@stop

@section('content')
    <x-adminlte-card theme="primary" theme-mode="outline">
        <div class="row mx-1 pb-2" >
            <button type="button" class="btn btn-primary">
                My HUB 로얄 멤버 신청서
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered border-label-light table-secondary d-none d-md-block">
                <tbody>
                    <tr>
                        <td class="title">성 명</td>
                        <td colspan="2">{{user()->first_name}}</td>
                    </tr>
                    <tr>
                        <td class="title">생년월일</td>
                        <td colspan="2">{{user()->dob}}</td>
                    </tr>
                    <tr>
                        <td class="title">연 락 처</td>
                        
                        <td colspan="2">
                            @if( count(user()->contacts) > 0)
                            {{ formatPhoneNumber(user()->contacts[0]->telephone_1) }}
                            @endif               
                        </td>
                    </tr>
                    <tr>
                        <td class="title">주요 혜택 및 내용</td>
                        <td colspan="2">
                            <ol>
                                <li>수수료 100% 지급 (일반회원은 50% 지급)</li>
                                <li>다른 멤버 추천 시, 추천 보너스 지급</li>
                                <li>P2U 코인 무상 지급, 각종 할인 바우처 제공 등</li>
                                <li>멤버십 기간 : 멤버 연간 사용료 납입 일자 포함 1년간 (365일)</li>
                                <li>멤버 혜택은 정책에 따라 추가, 삭제, 대체 지급될 수 있습니다. 자세한 내용은 공지사항 참조</li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td class="title">멤버십 연간 사용료</td>
                        <td colspan="2">290,000원 (회사 통장 계좌 이체 : 신한은행 : 140-013-869302 / ㈜비즈니스허브)</td>
                    </tr>
                    <tr>
                        <td class="title">로얄 멤버 회원 약관</td>
                        <td>
                            <ol>
                                <li>목적 : 이 약관은 ㈜비즈니스허브(이하 “당사”이라 함)와 로얄
                                    멤버 서비스를 이용하는 자 (이하 “멤버”라 함) 사이에 체결된
                                    계약에 따른 권리와 의무에 관한 사항을 목적으로 합니다.</li>
                                <li>유형 및 기간 : 당사가 정한 연간 사용료를 납부하고 멤버가 지
                                    정한 날짜를 시작으로 1년간 (365일)입니다. 종료일 이전에 멤
                                    버가 연장 신청을 하지 않은 경우는 종료일에 종료됩니다.
                                    계약 주기는 1년이며, 연 단위 갱신 신청할 수 있습니다.</li>
                                <li>멤버 시작일 : 멤버 사용료 입금일</li>
                                <li>멤버 종료일 : 멤버 사용료 입금 후 1년 후 (365일)</li>
                                <li>멤버 시작일 이후에 체결한 영업에 대해서만 멤버 혜택을
                                    적용하고, 일반 회원 등급에서 체결된 영업은 멤버 혜택을
                                    적용하지 않습니다.</li>
                            </ol>
                        </td>
                        <td>
                            <p class="mb-0">6. 멤버십 규정</p>
                            <ol>
                                <li>멤버십 양도는 불가합니다.</li>
                                <li>본인의 불가항력 사유(장기입원 등) 발생시 증빙서류를 제출하여 멤버십의 기간을 일정기간 임시 중단할 수 있습니다.</li>
                                <li>멤버 주요 혜택과 내용은 상황에 따라 추가, 삭제, 대체 지급/지원될 수 있으며 세부사항은 마이페이지 게시판을 통해 참고해 주세요.</li>
                                <li>영업위탁판매 규정 위반 지사대표 탈퇴 조치 또는 멤버가 자진 탈퇴 시 연간 사용료에 대한 잔여 금액은 반환하지 않습니다.</li>
                            </ol>
                            <p class="mb-0">7. 환불 약관</p>
                            <ol>
                                <li>연간 사용료 납입일 포함, 15일 이내 취소, 철회 요청시 100% 환불</li>
                                <li>취소, 철회의 경우 기간내 발생한 영업은 일반회원 규정을 적용</li>
                                <li>연간 사용료 납입 후, 15일 이후 철회 및 환불은 불가합니다.</li>
                            </ol>
                        </td>
                    </tr>
                </tbody>
            </table>
             <table class="table table-bordered border-label-light table-secondary d-block d-md-none">
                <tbody>
                    <tr>
                        <td class="text-center"><strong>성 명</strong></td>
                    </tr>
                    <tr>
                        <td>{{user()->first_name}}</td>
                    </tr>
                    <tr>
                        <td class="text-center"><strong>생년월일</strong></td>
                    </tr>
                    <tr>
                        <td>{{user()->dob}}</td>
                    </tr>
                    <tr>
                        <td class="text-center"><strong>연 락 처</strong></td>
                    </tr>
                    <tr>
                        <td>
                            @if( count(user()->contacts) > 0)
                            {{ formatPhoneNumber(user()->contacts[0]->telephone_1) }}
                            @endif    
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"><strong>주요 혜택 및 내용</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <ol>
                                <li>수수료 100% 지급 (일반회원은 50% 지급)</li>
                                <li>다른 멤버 추천 시, 추천 보너스 지급</li>
                                <li>P2U 코인 무상 지급, 각종 할인 바우처 제공 등</li>
                                <li>멤버십 기간 : 멤버 연간 사용료 납입 일자 포함 1년간 (365일)</li>
                                <li>멤버 혜택은 정책에 따라 추가, 삭제, 대체 지급될 수 있습니다. 자세한 내용은 공지사항 참조</li>
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"><strong>멤버십 연간 사용료</strong></td>
                    </tr>
                    <tr>
                        <td>290,000원 (회사 통장 계좌 이체 : 신한은행 : 140-013-869302 / ㈜비즈니스허브)</td>
                    </tr>
                    <tr>
                        <td class="text-center"><strong>로얄 멤버 회원 약관</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <ol>
                                <li>목적 : 이 약관은 ㈜비즈니스허브(이하 “당사”이라 함)와 로얄
                                    멤버 서비스를 이용하는 자 (이하 “멤버”라 함) 사이에 체결된
                                    계약에 따른 권리와 의무에 관한 사항을 목적으로 합니다.</li>
                                <li>유형 및 기간 : 당사가 정한 연간 사용료를 납부하고 멤버가 지
                                    정한 날짜를 시작으로 1년간 (365일)입니다. 종료일 이전에 멤
                                    버가 연장 신청을 하지 않은 경우는 종료일에 종료됩니다.
                                    계약 주기는 1년이며, 연 단위 갱신 신청할 수 있습니다.</li>
                                <li>멤버 시작일 : 멤버 사용료 입금일</li>
                                <li>멤버 종료일 : 멤버 사용료 입금 후 1년 후 (365일)</li>
                                <li>멤버 시작일 이후에 체결한 영업에 대해서만 멤버 혜택을
                                    적용하고, 일반 회원 등급에서 체결된 영업은 멤버 혜택을
                                    적용하지 않습니다.</li>
                                <li>멤버십 규정</li>
                                <ol>
                                    <li>멤버십 양도는 불가합니다.</li>
                                    <li>본인의 불가항력 사유(장기입원 등) 발생시 증빙서류를 제출하여 멤버십의 기간을 일정기간 임시 중단할 수 있습니다.</li>
                                    <li>멤버 주요 혜택과 내용은 상황에 따라 추가, 삭제, 대체 지급/지원될 수 있으며 세부사항은 마이페이지 게시판을 통해 참고해 주세요.</li>
                                    <li>영업위탁판매 규정 위반 지사대표 탈퇴 조치 또는 멤버가 자진 탈퇴 시 연간 사용료에 대한 잔여 금액은 반환하지 않습니다.</li>
                                </ol>
                                <li>환불 약관</li>
                                <ol>
                                    <li>연간 사용료 납입일 포함, 15일 이내 취소, 철회 요청시 100% 환불</li>
                                    <li>취소, 철회의 경우 기간내 발생한 영업은 일반회원 규정을 적용</li>
                                    <li>연간 사용료 납입 후, 15일 이후 철회 및 환불은 불가합니다.</li>
                                </ol>
                            </ol>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="py-2 term_txt">
            <p>※ 본인은 내용 및 회원 약관에 모두 확인하였으며 동의합니다.</p>
        </div>
        <form class="row justify-content-center g-2" id="form" method="post">
            <div class="col-8 col-md-7 d-flex justify-content-end">
                <div class="form-input">
                    <input type="text" id="text-field" class="form-control" placeholder="동의함" />
                </div>
            </div>
            <div class="col-4 col-md-5">
                <div class="form-button">
                    <button type="submit" id="submit-btn" disabled class="btn btn-primary apply" >신청하기</button>
                </div>
            </div>
            <div class="col-12 text-center">
                <p>※ “동의함” 이라고 직접 작성해 주세요.</p>
            </div>
        </form>

    </x-adminlte-card>
@stop

@section('js')
    <script>
        let inp = document.getElementById('text-field');
        let btn = document.getElementById('submit-btn');
        let form = document.getElementById('form');
        inp.addEventListener('keyup', () => {
            if (inp.value == '동의함' || inp.value.toLowerCase() == 'agree') {
                btn.disabled = false;
                return;
            }
            btn.disabled = true;
        })
        form.addEventListener('submit', () => {
            event.preventDefault()
            let text = $(event.target).find(':submit').text();
            $(event.target).find(':submit').html(
                `<span class="spinner-border me-1" role="status" aria-hidden="true"></span>${text}`);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $.ajax({
                url: "{{ route('admin.apply-royal-member.store') }}",
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    inp.value = '';
                    Swal.fire({
                        title: "완료",
                        icon: "success"
                    });
                },
                error: function(error) {
                    Swal.fire({
                        title: "Couldn't update",
                        icon: "error"
                    });
                }
            });
            $(event.target).find(':submit').html(text);
        })
    </script>
@stop
