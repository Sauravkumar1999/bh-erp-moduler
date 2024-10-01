@extends('layouts.landing-layout', ['title' => '이용약관'])
@push('css')
    <link rel="stylesheet" href="{{ themes('css/terms.css') }}">
    <link rel="stylesheet" href="{{ themes('css/bh-header') }}.css">
    <link rel="stylesheet" href="{{ themes('css/bh-footer') }}.css">
@endpush

@section('content')
    <div class="main">
        <div class="container">
            <div class="row mt-5 pt-3">
                <div class="col-12">
                    <div class="tab-terms-page">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="terms-of-use-tab" data-bs-toggle="pill" data-bs-target="#terms-of-use" type="button" role="tab" aria-controls="terms-of-use" aria-selected="true">이용약관</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="personal-information-collection-tab" data-bs-toggle="pill" data-bs-target="#personal-information-collection" type="button" role="tab" aria-controls="personal-information-collection" aria-selected="false">개인정보 수집 및 이용 동의</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="consent-to-provision-of-personal-info-tab" data-bs-toggle="pill" data-bs-target="#consent-to-provision-of-personal-info" type="button" role="tab" aria-controls="consent-to-provision-of-personal-info" aria-selected="false">개인정보 제3자 제공 동의</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="business-consignment-sales-regulation-tab" data-bs-toggle="pill" data-bs-target="#business-consignment-sales-regulation" type="button" role="tab" aria-controls="business-consignment-sales-regulation" aria-selected="false">영업 위탁판매 규정</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="terms-of-use" role="tabpanel" aria-labelledby="terms-of-use-tab">
                            <div class="terms">
                                <div class="terms1_title">
                                    <h3>비즈니스허브 이용 약관</h3>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제1조(목적)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <p>이 약관은 (주)비즈니스허브(이하 “회사”라 함)가 운영하는 인터넷 사이트 (이하 “사이트”라고 함)에서 제공하는 인터넷 관련 서비스를 이용함에 있어 “회사”와 “이용자”의 권리, 의무 및 책임사항을 규정함을 목적으로 합니다.</p>
                                        <p>※ PC통신, 모바일, 무선 등을 이용하는 전자상거래에 대해서도 그 성질에 반하지 않는 한 이 약관을 준용합니다.</p>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제2조 (용어의 정의)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        회사가 운영하는 사이트는 아래와 같습니다
                                                        https://businesshub.co.kr/ 추후 “회사”에서 공지하고 제공하는 기타 웹사이트
                                                        “사이트”란 “회사” 재화 또는 용역(이하 “재화 등”이라 함)을 이용자에게 제공하기 위하여 컴퓨터 등 정보통신설비를 이용하여 재화 및 용역 등을 거래할 수 있도록 설정한 가상의 영업장을 말합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “이용자”란 “사이트”에 접속하여 이 약관에 따라 “사이트”이 제공하는 서비스를 받는 회원 및 비회원을 말합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ‘회원’이라 함은 “사이트”에 회원등록 또는 지사대표(Biz Planner) 또는 본부대표(Managing Director)로 등록된 모든 자로서, 계속적으로 “사이트”가 제공하는 서비스를 이용할 수 있는 자를 말합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ‘비회원’이라 함은 회원에 가입하지 않고 “사이트”에서 제공하는 서비스를 이용하는 자를 말합니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제3조 (약관 등의 명시와 설명 및 개정)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 이 약관의 내용과 상호 및 대표자 성명, 영업소 소재지 주소(소비자의 불만을 처리할 수 있는 곳의 주소를 포함), 전화번호.모사전송번호.전자우편주소, 사업자등록번호, 통신판매업 신고번호, 개인정보보호 책임자 등을 이용자가 쉽게 알 수 있도록 사이트의 초기 서비스화면(전면)에 게시합니다. 다만, 약관의 내용은 이용자가 연결화면을 통하여 볼 수 있도록 할 수 있습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 이용자가 약관에 동의하기에 앞서 약관에 정해져 있는 내용 중 청약철회.배송책임.환불조건 등과 같은 중요한 내용을 이용자가 이해할 수 있도록 별도의 연결화면 또는 팝업화면 등을 제공하여 이용자의 확인을 구하여야 합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 「전자상거래 등에서의 소비자보호에 관한 법률」, 「약관의 규제에 관한 법률」, 「전자문서 및 전자거래기본법」, 「전자금융거래법」, 「전자서명법」, 「정보통신망 이용촉진 및 정보보호 등에 관한 법률」, 「방문판매 등에 관한 법률」, 「소비자기본법」 등 관련 법을 위배하지 않는 범위에서 이 약관을 개정할 수 있습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 약관을 개정할 경우에는 적용일자 및 개정사유를 명시하여 현행약관과 함께 사이트의 초기화면에 그 적용일자 7일 이전부터 적용일자 전일까지 공지합니다. 다만, 이용자에게 불리하게 약관내용을 변경하는 경우에는 최소한 30일 이상의 사전 유예기간을 두고 공지합니다. 이 경우 “회사“는 개정 전 내용과 개정 후 내용을 명확하게 비교하여 이용자가 알기 쉽도록 표시합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>5</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”가 약관을 개정할 경우에는 그 개정약관은 그 적용일자 이후에 체결되는 계약에만 적용되고 그 이전에 이미 체결된 계약에 대해서는 개정 전의 약관조항이 그대로 적용됩니다. 다만 이미 계약을 체결한 이용자가 개정약관 조항의 적용을 받기를 원하는 뜻을 제3항에 의한 개정약관의 공지기간 내에 “회사”에 송신하여 “회사”의 동의를 받은 경우에는 개정약관 조항이 적용됩니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>6</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        이 약관에서 정하지 아니한 사항과 이 약관의 해석에 관하여는 전자상거래 등에서의 소비자보호에 관한 법률, 약관의 규제 등에 관한 법률, 공정거래위원회가 정하는 전자상거래 등에서의 소비자 보호지침 및 관계법령 또는 상관례에 따릅니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제4조(서비스의 제공 및 변경)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 다음과 같은 업무를 수행합니다.
                                                        <ol class="sub_list_ol">
                                                            <li class="list_sub">
                                                                재화 및 용역의 거래를 위한 매칭 플랫폼 운영 서비스
                                                            </li>
                                                            <li class="list_sub">
                                                                “사이트”의 개발 및 운영 서비스
                                                            </li>
                                                            <li class="list_sub">
                                                                상품 및 용역에 대한 정보 제공 및 관련 업무 지원 서비스
                                                            </li>
                                                            <li class="list_sub">
                                                                구매계약이 체결된 재화 또는 용역의 배송
                                                            </li>
                                                            <li class="list_sub">
                                                                기타 “회사”가 정하는 업무
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 재화 또는 용역의 품절 또는 기술적 사양의 변경 등의 경우에는 장차 체결되는 계약에 의해 제공할 재화 또는 용역의 내용을 변경할 수 있습니다. 이 경우에는 변경된 재화 또는 용역의 내용 및 제공일자를 명시하여 현재의 재화 또는 용역의 내용을 게시한 곳에 즉시 공지합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 재화 또는 용역의 품절 또는 기술적 사양의 변경 등의 경우에는 장차 체결되는 계약에 의해 제공할 재화 또는 용역의 내용을 변경할 수 있습니다. 이 경우에는 변경된 재화 또는 용역의 내용 및 제공일자를 명시하여 현재의 재화 또는 용역의 내용을 게시한 곳에 즉시 공지합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        전항의 경우 “회사”에서 이용자가 입은 손해를 배상합니다. 다만, “회사”의 고의 또는 과실이 없음을 입증하는 경우에는 그러하지 아니합니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제5조(서비스의 중단)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       “회사”는 컴퓨터 등 정보통신설비의 보수점검.교체 및 고장, 통신의 두절 등의 사유가 발생한 경우에는 서비스의 제공을 일시적으로 중단할 수 있습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 제1항의 사유로 서비스의 제공이 일시적으로 중단됨으로 인하여 이용자 또는 제3자가 입은 손해에 대하여 배상합니다. 단, “회사”의 고의 또는 과실이 없음을 입증하는 경우에는 그러하지 아니합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        사업종목의 전환, 사업의 포기, 업체 간의 통합 등의 이유로 서비스를 제공할 수 없게 되는 경우에는 “회사”는 제8조에 정한 방법으로 이용자에게 통지하고 당초 “사이트”에서 제시한 조건에 따라 소비자에게 보상합니다. 다만, “사이트”에서 보상기준 등을 고지하지 아니한 경우에는 이용자들의 마일리지 또는 적립금 등을 “사이트”에서 통용되는 통화가치에 상응하는 현물 또는 현금으로 이용자에게 지급합니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제6조(회원가입)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       이용자는 “사이트”에서 정한 가입 양식에 따라 회원정보를 기입한 후 이 약관에 동의한다는 의사표시를 함으로서 회원가입을 신청합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “사이트”에서 제1항과 같이 회원으로 가입할 것을 신청한 이용자 중 다음 각 호에 해당하지 않는 한 회원으로 등록합니다.
                                                        <ol class="sub_list_ol">
                                                            <li class="list_sub">
                                                                가입신청자가 이 약관 제7조제3항에 의하여 이전에 회원자격을 상실한 적이 있는 경우, 다만 제7조제3항에 의한 회원자격 상실 후 3년이 경과한 자로서 “회사”의 회원 재가입 승낙을 얻은 경우에는 예외로 한다.
                                                            </li>
                                                            <li class="list_sub">
                                                                등록 내용에 허위, 기재누락, 오기가 있는 경우
                                                            </li>
                                                            <li class="list_sub">
                                                                기타 회원으로 등록하는 것이 “회사”의 기술상 현저히 지장이 있다고 판단되는 경우
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        회원가입계약의 성립 시기는 “회사”의 승낙이 회원에게 도달한 시점으로 합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        회원은 회원가입 시 등록한 사항에 변경이 있는 경우, 상당한 기간 이내에 “사이트”에 대하여 회원정보 수정 등의 방법으로 그 변경사항을 알려야 합니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제7조(회원 탈퇴 및 자격 상실 등)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       회원은 “사이트”에서 언제든지 탈퇴를 요청할 수 있으며 “회사”에서는 즉시 회원탈퇴를 처리합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        회원이 다음 각 호의 사유에 해당하는 경우, “사이트”에서 회원자격을 제한 및 정지시킬 수 있습니다.
                                                        <ol class="sub_list_ol">
                                                            <li class="list_sub">
                                                                가입 신청 시에 허위 내용을 등록한 경우
                                                            </li>
                                                            <li class="list_sub">
                                                                “사이트”을 이용하여 구입한 재화 등의 대금, 기타 “사이트”이용에 관련하여 회원이 부담하는 채무를 기일에 지급하지 않는 경우
                                                            </li>
                                                            <li class="list_sub">
                                                                다른 사람의 “사이트” 이용을 방해하거나 그 정보를 도용하는 등 전자상거래 질서를 위협하는 경우
                                                            </li>
                                                            <li class="list_sub">
                                                                “사이트”를 이용하여 법령 또는 이 약관이 금지하거나 공서양속에 반하는 행위를 하는 경우
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “사이트”이 회원 자격을 제한.정지 시킨 후, 동일한 행위가 2회 이상 반복되거나 30일 이내에 그 사유가 시정되지 아니하는 경우 “사이트”은 회원자격을 상실시킬 수 있습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “사이트”이 회원자격을 상실시키는 경우에는 회원등록을 말소합니다. 이 경우 회원에게 이를 통지하고, 회원등록 말소 전에 최소한 30일 이상의 기간을 정하여 소명할 기회를 부여합니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제8조(회원에 대한 통지)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       “회사”의 회원에 대한 통지를 하는 경우, 회원이 “회사”와 미리 약정하여 지정한 전자우편 주소로 할 수 있습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 불특정다수 회원에 대한 통지의 경우 1주일이상 “사이트” 게시판에 게시함으로써 개별 통지에 갈음할 수 있습니다. 다만, 회원 본인의 거래와 관련하여 중대한 영향을 미치는 사항에 대하여는 개별통지를 합니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제9조(구매신청)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       “사이트”이용자는 “사이트”상에서 다음 또는 이와 유사한 방법에 의하여 구매를 신청하며, “사이트” 이용자가 구매신청을 함에 있어서 다음의 각 내용을 알기 쉽게 제공하여야 합니다.
                                                       <ol class="sub_list_ol">
                                                            <li class="list_sub">
                                                                재화 등의 검색 및 선택
                                                            </li>
                                                            <li class="list_sub">
                                                                받는 사람의 성명, 주소, 전화번호, 전자우편주소(또는 이동전화번호) 등의 입력
                                                            </li>
                                                            <li class="list_sub">
                                                                약관내용, 청약철회권이 제한되는 서비스, 배송료, 설치비 등의 비용부담과 관련한 내용에 대한 확인
                                                            </li>
                                                            <li class="list_sub">
                                                                이 약관에 동의하고 위 3호의 사항을 확인하거나 거부하는 표시(예, 마우스 클릭)
                                                            </li>
                                                            <li class="list_sub">
                                                                재화 등의 구매신청 및 이에 관한 확인 또는 “회사”의 확인에 대한 동의
                                                            </li>
                                                            <li class="list_sub">
                                                                결제방법의 선택
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 제3자에게 구매자 개인정보를 제공·위탁할 필요가 있는 경우 실제 구매신청 시 구매자의 동의를 받아야 하며, 회원가입 시 미리 포괄적으로 동의를 받지 않습니다. 이 때 “회사”는 제공되는 개인정보 항목, 제공받는 자, 제공받는 자의 개인정보 이용 목적 및 보유·이용 기간 등을 구매자에게 명시하여야 합니다. 다만 「정보통신망이용촉진 및 정보보호 등에 관한 법률」 제25조 제1항에 의한 개인정보 처리위탁의 경우 등 관련 법령에 달리 정함이 있는 경우에는 그에 따릅니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제10조 (계약의 성립)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       “회사”는 제9조와 같은 구매신청에 대하여 다음 각 호에 해당하면 승낙하지 않을 수 있습니다. 다만, 미성년자와 계약을 체결하는 경우에는 법정대리인의 동의를 얻지 못하면 미성년자 본인 또는 법정대리인이 계약을 취소할 수 있다는 내용을 고지하여야 합니다.
                                                       <ol class="sub_list_ol">
                                                            <li class="list_sub">
                                                                신청 내용에 허위, 기재누락, 오기가 있는 경우
                                                            </li>
                                                            <li class="list_sub">
                                                                미성년자가 담배, 주류 등 청소년보호법에서 금지하는 재화 및 용역을 구매하는 경우
                                                            </li>
                                                            <li class="list_sub">
                                                                기타 구매신청에 승낙하는 것이 “회사” 기술상 현저히 지장이 있다고 판단하는 경우
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”의 승낙이 제12조제1항의 수신확인통지형태로 이용자에게 도달한 시점에 계약이 성립한 것으로 봅니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”의 승낙의 의사표시에는 이용자의 구매 신청에 대한 확인 및 판매가능 여부, 구매신청의 정정 취소 등에 관한 정보 등을 포함하여야 합니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제11조(지급방법)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <li>
                                                       “회사”에서 구매한 재화 또는 용역에 대한 대금지급방법은 다음 각 호의 방법중 가용한 방법으로 할 수 있습니다. 단, “회사”는 이용자의 지급방법에 대하여 재화 등의 대금에 어떠한 명목의 수수료도 추가하여 징수할 수 없습니다.
                                                        <ol class="sub_list_ol">
                                                            <li class="list_sub">
                                                                폰뱅킹, 인터넷뱅킹, 메일 뱅킹 등의 각종 계좌이체
                                                            </li>
                                                            <li class="list_sub">
                                                                선불카드, 직불카드, 신용카드 등의 각종 카드 결제
                                                            </li>
                                                            <li class="list_sub">
                                                                온라인 무통장입금
                                                            </li>
                                                            <li class="list_sub">
                                                                전자화폐에 의한 결제
                                                            </li>
                                                            <li class="list_sub">
                                                                수령 시 대금지급
                                                            </li>
                                                            <li class="list_sub">
                                                                마일리지 등 “회사”에서 지급한 포인트에 의한 결제
                                                            </li>
                                                            <li class="list_sub">
                                                                “회사”와 계약을 맺었거나 “회사”가 인정한 상품권에 의한 결제
                                                            </li>
                                                            <li class="list_sub">
                                                                기타 전자적 지급 방법에 의한 대금 지급 등
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </div>
                                            </div>
                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제12조(수신확인통지.구매신청 변경 및 취소)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 이용자의 구매신청이 있는 경우 이용자에게 수신확인통지를 합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        수신확인통지를 받은 이용자는 의사표시의 불일치 등이 있는 경우에는 수신확인통지를 받은 후 즉시 구매신청 변경 및 취소를 요청할 수 있고 “회사”에서 배송 전에 이용자의 요청이 있는 경우에는 지체 없이 그 요청에 따라 처리하여야 합니다. 다만 이미 대금을 지불한 경우에는 제15조의 청약철회 등에 관한 규정에 따릅니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제13조(재화 등의 공급)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 이용자와 재화 등의 공급시기에 관하여 별도의 약정이 없는 이상, 이용자가 청약을 한 날부터 7일 이내에 재화 등을 배송할 수 있도록 주문제작, 포장 등 기타의 필요한 조치를 취합니다. 다만, “회사”는 이미 재화 등의 대금의 전부 또는 일부를 받은 경우에는 대금의 전부 또는 일부를 받은 날부터 3영업일 이내에 조치를 취합니다. 이때 “회사”는 이용자가 재화 등의 공급 절차 및 진행 사항을 확인할 수 있도록 적절한 조치를 합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 이용자가 구매한 재화에 대해 배송수단, 수단별 배송비용 부담자, 수단별 배송기간 등을 명시합니다. 만약 “회사”에서 약정 배송기간을 초과한 경우에는 그로 인한 이용자의 손해를 배상하여야 합니다. 다만 “회사”가 고의.과실이 없음을 입증한 경우에는 그러하지 아니합니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제14조(환급)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <li>
                                                        이용자가 “회사”에 구매신청한 재화 등이 품절 등의 사유로 인도 또는 제공을 할 수 없을 때에는 지체 없이 그 사유를 이용자에게 통지하고 사전에 재화 등의 대금을 받은 경우에는 대금을 받은 날부터 3영업일 이내에 환급하거나 환급에 필요한 조치를 취합니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제15조(청약철회 등)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”와 재화 등의 구매에 관한 계약을 체결한 이용자는 「전자상거래 등에서의 소비자보호에 관한 법률」 제13조 제2항에 따른 계약내용에 관한 서면을 받은 날(그 서면을 받은 때보다 재화 등의 공급이 늦게 이루어진 경우에는 재화 등을 공급받거나 재화 등의 공급이 시작된 날을 말합니다)부터 7일 이내에는 청약의 철회를 할 수 있습니다. 다만, 청약철회에 관하여 「전자상거래 등에서의 소비자보호에 관한 법률」에 달리 정함이 있는 경우에는 동 법 규정에 따릅니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        이용자는 재화 등을 배송 받은 경우 다음 각 호의 1에 해당하는 경우에는 반품 및 교환을 할 수 없습니다.
                                                        <ol class="sub_list_ol">
                                                            <li class="list_sub">
                                                                이용자에게 책임 있는 사유로 재화 등이 멸실 또는 훼손된 경우(다만, 재화 등의 내용을 확인하기 위하여 포장 등을 훼손한 경우에는 청약철회를 할 수 있습니다)
                                                            </li>
                                                            <li class="list_sub">
                                                                이용자의 사용 또는 일부 소비에 의하여 재화 등의 가치가 현저히 감소한 경우
                                                            </li>
                                                            <li class="list_sub">
                                                                시간의 경과에 의하여 재판매가 곤란할 정도로 재화등의 가치가 현저히 감소한 경우
                                                            </li>
                                                            <li class="list_sub">
                                                                같은 성능을 지닌 재화 등으로 복제가 가능한 경우 그 원본인 재화 등의 포장을 훼손한 경우
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        제2항제2호 내지 제4호의 경우에 “회사”에 사전에 청약철회 등이 제한되는 사실을 소비자가 쉽게 알 수 있는 곳에 명기하거나 시용상품을 제공하는 등의 조치를 하지 않았다면 이용자의 청약철회 등이 제한되지 않습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        이용자는 제1항 및 제2항의 규정에 불구하고 재화 등의 내용이 표시·광고 내용과 다르거나 계약내용과 다르게 이행된 때에는 당해 재화 등을 공급받은 날부터 3월 이내, 그 사실을 안 날 또는 알 수 있었던 날부터 30일 이내에 청약철회 등을 할 수 있습니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제16조(청약철회 등의 효과)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”에서 이용자로부터 재화 등을 반환받은 경우 3영업일 이내에 이미 지급받은 재화 등의 대금을 환급합니다. 이 경우 “회사”에서 이용자에게 재화등의 환급을 지연한때에는 그 지연기간에 대하여 「전자상거래 등에서의 소비자보호에 관한 법률 시행령」제21조의2에서 정하는 지연이자율(괄호 부분 삭제)을 곱하여 산정한 지연이자를 지급합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”에서 위 대금을 환급함에 있어서 이용자가 신용카드 또는 전자화폐 등의 결제수단으로 재화 등의 대금을 지급한 때에는 지체 없이 당해 결제수단을 제공한 사업자로 하여금 재화 등의 대금의 청구를 정지 또는 취소하도록 요청합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        청약철회 등의 경우 공급받은 재화 등의 반환에 필요한 비용은 이용자가 부담합니다. “회사”는 이용자에게 청약철회 등을 이유로 위약금 또는 손해배상을 청구하지 않습니다. 다만 재화 등의 내용이 표시·광고 내용과 다르거나 계약내용과 다르게 이행되어 청약철회 등을 하는 경우 재화 등의 반환에 필요한 비용은 “회사”가 부담합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        이용자가 재화 등을 제공받을 때 발송비를 부담한 경우에 “회사”는 청약철회 시 그 비용을 누가 부담하는지를 이용자가 알기 쉽도록 명확하게 표시합니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제17조(개인정보보호)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 이용자의 개인정보 수집시 서비스제공을 위하여 필요한 범위에서 최소한의 개인정보를 수집합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 회원가입시 구매계약이행에 필요한 정보를 미리 수집하지 않습니다. 다만, 관련 법령상 의무이행을 위하여 구매계약 이전에 본인확인이 필요한 경우로서 최소한의 특정 개인정보를 수집하는 경우에는 그러하지 아니합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 이용자의 개인정보를 수집·이용하는 때에는 당해 이용자에게 그 목적을 고지하고 동의를 받습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 수집된 개인정보를 목적 외의 용도로 이용할 수 없으며, 새로운 이용목적이 발생한 경우 또는 제3자에게 제공하는 경우에는 이용·제공단계에서 당해 이용자에게 그 목적을 고지하고 동의를 받습니다. 다만, 관련 법령에 달리 정함이 있는 경우에는 예외로 합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>5</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 제2항과 제3항에 의해 이용자의 동의를 받아야 하는 경우에는 개인정보보호 책임자의 신원(소속, 성명 및 전화번호, 기타 연락처), 정보의 수집목적 및 이용목적, 제3자에 대한 정보제공 관련사항(제공받은자, 제공목적 및 제공할 정보의 내용) 등 「정보통신망 이용촉진 및 정보보호 등에 관한 법률」 제22조제2항이 규정한 사항을 미리 명시하거나 고지해야 하며 이용자는 언제든지 이 동의를 철회할 수 있습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>6</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        이용자는 언제든지 “회사”가 가지고 있는 자신의 개인정보에 대해 열람 및 오류정정을 요구할 수 있으며 “회사”는 이에 대해 지체 없이 필요한 조치를 취할 의무를 집니다. 이용자가 오류의 정정을 요구한 경우에는 “회사”는 그 오류를 정정할 때까지 당해 개인정보를 이용하지 않습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>7</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 개인정보 보호를 위하여 이용자의 개인정보를 처리하는 자를 최소한으로 제한하여야 하며 신용카드, 은행계좌 등을 포함한 이용자의 개인정보의 분실, 도난, 유출, 동의 없는 제3자 제공, 변조 등으로 인한 이용자의 손해에 대하여 모든 책임을 집니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>8</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사” 또는 그로부터 개인정보를 제공받은 제3자는 개인정보의 수집목적 또는 제공받은 목적을 달성한 때에는 당해 개인정보를 지체 없이 파기합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>9</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 개인정보의 수집·이용·제공에 관한 동의란을 미리 선택한 것으로 설정해두지 않습니다. 또한 개인정보의 수집·이용·제공에 관한 이용자의 동의거절시 제한되는 서비스를 구체적으로 명시하고, 필수수집항목이 아닌 개인정보의 수집·이용·제공에 관한 이용자의 동의 거절을 이유로 회원가입 등 서비스 제공을 제한하거나 거절하지 않습니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제18조(“회사“의 의무)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 법령과 이 약관이 금지하거나 공서양속에 반하는 행위를 하지 않으며 이 약관이 정하는 바에 따라 지속적이고, 안정적으로 재화.용역을 제공하는데 최선을 다하여야 합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 이용자가 안전하게 인터넷 서비스를 이용할 수 있도록 이용자의 개인정보(신용정보 포함)보호를 위한 보안 시스템을 갖추어야 합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 상품이나 용역에 대하여 「표시.광고의 공정화에 관한 법률」 제3조 소정의 부당한 표시.광고행위를 함으로써 이용자가 손해를 입은 때에는 이를 배상할 책임을 집니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 이용자가 원하지 않는 영리목적의 광고성 전자우편을 발송하지 않습니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제19조(회원의 ID 및 비밀번호에 대한 의무)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        제17조의 경우를 제외한 ID와 비밀번호에 관한 관리책임은 회원에게 있습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        회원은 자신의 ID 및 비밀번호를 제3자에게 이용하게 해서는 안됩니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        회원이 자신의 ID 및 비밀번호를 도난당하거나 제3자가 사용하고 있음을 인지한 경우에는 바로 “회사”에 통보하고 “회사”의 안내가 있는 경우에는 그에 따라야 합니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제20조(이용자의 의무)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <li>
                                                       이용자는 다음 행위를 하여서는 안 됩니다.
                                                        <ol class="sub_list_ol">
                                                            <li class="list_sub">
                                                                신청 또는 변경시 허위 내용의 등록
                                                            </li>
                                                            <li class="list_sub">
                                                                타인의 정보 도용
                                                            </li>
                                                            <li class="list_sub">
                                                                “회사”에 게시된 정보의 변경
                                                            </li>
                                                            <li class="list_sub">
                                                                “회사”에 정한 정보 이외의 정보(컴퓨터 프로그램 등) 등의 송신 또는 게시
                                                            </li>
                                                            <li class="list_sub">
                                                                “회사”에 기타 제3자의 저작권 등 지적재산권에 대한 침해
                                                            </li>
                                                            <li class="list_sub">
                                                                “회사” 기타 제3자의 명예를 손상시키거나 업무를 방해하는 행위
                                                            </li>
                                                            <li class="list_sub">
                                                                외설 또는 폭력적인 메시지, 화상, 음성, 기타 공서양속에 반하는 정보를 사이트에 공개 또는 게시하는 행위
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </div>
                                            </div>
                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제21조(연결“사이트”과 피연결“사이트” 간의 관계)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        상위 “사이트”과 하위 “사이트”이 하이퍼링크(예: 하이퍼링크의 대상에는 문자, 그림 및 동화상 등이 포함됨)방식 등으로 연결된 경우, 전자를 연결 “사이트”(웹 사이트)이라고 하고 후자를 피연결 “사이트”(웹사이트)이라고 합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        연결“사이트”은 피연결“사이트”이 독자적으로 제공하는 재화 등에 의하여 이용자와 행하는 거래에 대해서 보증 책임을 지지 않는다는 뜻을 연결“사이트”의 초기화면 또는 연결되는 시점의 팝업화면으로 명시한 경우에는 그 거래에 대한 보증 책임을 지지 않습니다.
                                                    </li>
                                                </div>
                                            </div>
                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제22조(저작권의 귀속 및 이용제한)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사“가 작성한 저작물에 대한 저작권 기타 지적재산권은 ”회사“에 귀속합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        이용자는 “사이트”를 이용함으로써 얻은 정보 중 “회사”에게 지적재산권이 귀속된 정보를 “회사”의 사전 승낙 없이 복제, 송신, 출판, 배포, 방송 기타 방법에 의하여 영리목적으로 이용하거나 제3자에게 이용하게 하여서는 안됩니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 약정에 따라 이용자에게 귀속된 저작권을 사용하는 경우 당해 이용자에게 통보하여야 합니다.
                                                    </li>
                                                </div>
                                            </div>
                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제23조(분쟁해결)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 이용자가 제기하는 정당한 의견이나 불만을 반영하고 그 피해를 보상처리하기 위하여 피해보상처리기구를 설치.운영합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”는 이용자로부터 제출되는 불만사항 및 의견은 우선적으로 그 사항을 처리합니다. 다만, 신속한 처리가 곤란한 경우에는 이용자에게 그 사유와 처리일정을 즉시 통보해 드립니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”와 이용자 간에 발생한 전자상거래 분쟁과 관련하여 이용자의 피해구제신청이 있는 경우에는 공정거래위원회 또는 시·도지사가 의뢰하는 분쟁조정기관의 조정에 따를 수 있습니다.
                                                    </li>
                                                </div>
                                            </div>
                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제24조(재판권 및 준거법)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”와 이용자 간에 발생한 전자상거래 분쟁에 관한 소송은 제소 당시의 이용자의 주소에 의하고, 주소가 없는 경우에는 거소를 관할하는 지방법원의 전속관할로 합니다. 다만, 제소 당시 이용자의 주소 또는 거소가 분명하지 않거나 외국 거주자의 경우에는 민사소송법상의 관할법원에 제기합니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “회사”와 이용자 간에 제기된 전자상거래 소송에는 한국법을 적용합니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>부 칙</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        이 약관은 2023년 2월 1일부터 시행합니다.
                                                    </li>
                                                </div>
                                            </div>
                                        </ol>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="personal-information-collection" role="tabpanel" aria-labelledby="personal-information-collection-tab">
                            <div class="terms">
                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title d-none">
                                        <b>제4조(서비스의 제공 및 변경)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        개인정보 수집목적 및 이용목적
                                                        가. 상품 및 용역 서비스 제공에 관한 계약 이행 및 고객 상품과 서비스 매칭 지원에 따른
                                                        콘텐츠 제공, 구매 및 요금 결제, 물품배송 또는 청구지 등 발송, 금융거래 본인 인증 및 금융 서비스, 수당 지급 등에 대한 정보 제공
                                                        나. 회원 관리
                                                        회원제 서비스 이용에 따른 본인확인 , 개인 식별 , 불량회원의 부정 이용 방지와 비인가 사용 방지 , 가입 의사 확인 , 연령확인 , 만14세 미만 아동 개인정보 수집 시 법정 대리인 동의여부 확인, 고객 불만처리 등 민원처리 , 고지사항 전달
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        수집하는 개인정보 항목 : 이름 , 로그인ID , 비밀번호 , 생년월일, 휴대전화번호, 이메일, 수당 지급을 위한 신분증 및 은행 및 계좌번호, 14세미만 가입자의 경우 법정대리인의 정보
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        개인정보의 보유기간 및 이용기간
                                                        원칙적으로, 개인정보 수집 및 이용목적이 달성된 후에는 해당 정보를 지체 없이 파기합니다. 단, 다음의 정보에 대해서는 아래의 이유로 명시한 기간 동안 보존합니다.
                                                        가. 회사 내부 방침에 의한 정보 보유 사유
                                                        <ul class="sub_list_ol">
                                                            <li class="mt-3">
                                                                부정거래 방지 및 쇼핑몰 운영방침에 따른 보관 : 5년
                                                                나. 관련 법령에 의한 정보보유 사유
                                                            </li>
                                                            <li class="mt-3">
                                                                계약 또는 청약철회 등에 관한 기록
                                                                <ol>
                                                                    <li class="mt-3">
                                                                        <b>-보존이유 :</b>&nbsp; 전자상거래등에서의 소비자보호에 관한 법률
                                                                    </li>
                                                                    <li class="mt-2">
                                                                        <b>-보존기간 :</b> &nbsp; 5년
                                                                    </li>
                                                                </ol>
                                                            </li>
                                                            <li class="mt-3">
                                                                대금 결제 및 재화 등의 공급에 관한 기록
                                                                <ol>
                                                                    <li class="mt-3">
                                                                        <b>-보존이유: </b>&nbsp; 전자상거래등에서의 소비자보호에 관한 법률
                                                                    </li>
                                                                    <li class="mt-2">
                                                                        <b>-보존기간 :</b> &nbsp; 5년
                                                                    </li>
                                                                </ol>
                                                            </li>
                                                            <li class="mt-3">
                                                                소비자 불만 또는 분쟁처리에 관한 기록
                                                                <ol>
                                                                    <li class="mt-3">
                                                                        <b>-보존이유:</b> &nbsp; 전자상거래등에서의 소비자보호에 관한 법률
                                                                    </li>
                                                                    <li class="mt-2">
                                                                        <b>-보존기간 :</b> &nbsp; 3년
                                                                    </li>
                                                                </ol>
                                                            </li>
                                                            <li class="mt-3">
                                                                로그 기록
                                                                <ol>
                                                                    <li class="mt-3">
                                                                        <b>-보존이유:</b>&nbsp; 통신비밀보호법
                                                                    </li>
                                                                    <li class="mt-2">
                                                                        <b>-보존기간 :</b> &nbsp; 3개월
                                                                    </li>
                                                                </ol>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <li>
                                                        ※ 동의를 거부할 수 있으나 거부시 회원 가입이 불가능합니다
                                                    </li>
                                                </div>
                                            </div>


                                        </ol>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="tab-pane fade" id="consent-to-provision-of-personal-info" role="tabpanel" aria-labelledby="consent-to-provision-of-personal-info-tab">
                            <div class="terms">
                                <div class="terms1_title text-center">
                                    <h3><b>제3자 개인정보 제공 동의</b></h3>
                                </div>
                                <div class="terms1_title">
                                    <h5>제 3자에 대한 제공 및 공유</h5>
                                </div>
                                <div class="">
                                    <table class="mt-3">
                                        <tr class="table_terms">
                                            <td width="10%">구분</td>
                                            <td width="30%">개인정보 제공 받는 자</td>
                                            <td width="20%">개인정보 이용목적</td>
                                            <td width="20%">개인정보 제공 항목</td>
                                            <td width="20%">보유 및 이용 기간</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                제휴
                                                업체
                                            </td>
                                            <td>
                                                ㈜비즈케어
                                                ㈜금광E&T
                                                메타스타글로벌㈜
                                                한바다 세무법인
                                                무지개 세무법인
                                                리원 세무법인
                                                리원엑스
                                                한국기업경영컨설팅
                                                ㈜엘티아이엘
                                                ㈜휴먼셀헬스케어
                                                한바이오㈜
                                                ㈜위고,꽃보사
                                                ㈜포인투유
                                                54DNA
                                                ㈜제로케이
                                                오토플래너㈜
                                                ㈜L2K디자인
                                            </td>
                                            <td rowspan="2">
                                                비즈니스 아이템 판매를 위한 기본 항목
                                                정보 제공, 해당 상품 및 서비스의 청약 의사의 확인, 거래 이행, 배송, 고객상담, A/S등 불만처리
                                                광고, 이벤트 및 프로모션 공지
                                                회사 정보 공지
                                            </td>
                                            <td rowspan="2">
                                                이름, 성별, 휴대폰 번호,이메일, 생년월일, 주소
                                            </td>
                                            <td rowspan="2">
                                                개인정보 이용목적 달성시 까지 (단, 관계법령의 규정에 의해 보존의 필요가 있는 경우 및 사전 동의를 득한 경우는 해당기간까지)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                기타
                                            </td>
                                            <td>
                                                ㈜비즈니스허브와 상품 판매 계약 체결을 완료한 신규 추가 제휴업체
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="business-consignment-sales-regulation" role="tabpanel" aria-labelledby="business-consignment-sales-regulation-tab">

                            <div class="terms">
                                <div class="terms1_title">
                                    <h3>영업 위탁 판매에 대한 규정</h3>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_details mt-3">
                                        <p>㈜비즈니스 허브 (이하 “동”이라 한다)와 지사대표(Biz Planner) 또는 본부대표(Managing Director) (이하 각각 모두 “행”이라 한다)는 “동”이 제공/판매하는 모든 상품을 “행”에게 판매 위탁하기 위하여 다음과 같은 규정에 동의하여야 최종 등록이 완료가 됩니다.</p>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제1조 (규정의 목적)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <li>
                                                        본 규정은 “동”이 “행”에게 상품의 판매를 위탁하고 “행”은 “동”으로부터 판매 위탁 받은 상품을 판매하는 것(이하 “본건 위탁판매”)과 관련된 “동”과 “행”의 권리, 의무, 내부 규정에 대한 이해와 동의를 그 목적으로 한다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제2조 (“행”의 역할과 지위)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”은 본 규정이 정하는 바에 따라 “동”으로부터 판매를 위탁 받은 상품 및 서비스(이하 “위탁상품”)에 대하여 자신을 매도인으로, 위탁상품의 소비자(이하 “고객” 이라 한다)를 매수인으로 하여 “동”이 제공하는 온라인 양식 또는 오프라인 청약서(약정서 포함)로 진행되거나 또는 “동”의 판매 제휴사에게 세일즈가 진행되도록 소개 연결한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”은 위탁상품의 판매활동과 관련하여 발생하는 모든 비용은 스스로 부담한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”은 고객 또는 제3자에 대하여 회사 명의로 채무를 부담하여서는 안되며, “동”을 본 규정에서 정하고 있는 사항 이외에 회사를 대리하여 어떠한 행위도 하여서는 아니된다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”은 “동”과 고용 및 근로 관계가 성립하지 않고, 근로기준법상 회사의 정규직원에 대한 취업규칙 및 기타 규정은 “행”에게는 적용받지 않는다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제3조 (“행”의 준수의무) </b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”은 방문판매 등에 대한 법률, 할부거래에 관한 법률, 소득세법 및 기타 제반 관련 법령과 본 규정의 이행을 위하여 “동”이 정한 규정을 준수하여야 한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”은 “동”에서 정한 판매조건 및 판매방법에 따라 상품을 판매하여야 하며, 과대 선전이나 허위광고 등을 하지 않아야 한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”이 “동”의 브랜드, 상호, 제품명, 법인명의 전부 또는 일부를 사용한 광고, 기고, 저작 등(이하 “광고 등”)의 행위를 할 경우에는 “동”과 사전에 보고하고 “동”의 서면동의를 받아야 한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”은 “동”의 위탁상품에 대한 영업 등을 수행하는 과정에서 알게 된 “동”의 영업비밀과 정보, 자료 등을 “동”의 동의 없이 제3자에게 제공하여서는 아니된다. 다만, “동”과 합의가 있는 경우에는 예외로 한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>5</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”은 회원 활동 중 또는 회원 탈퇴 후 1년간 “동”의 유사/동종 업종 관련 사업을 영위할 수 없다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제4조 (판매 수수료 및 중요 사항 공지)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”동”은 “행”에게 판매수수료 규정 및 기준 등 주요 내용에 대해서 “동”의 홈페이지 게시판을 통한 공지 또는 이메일 또는 문자를 통하여 공지한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       ”행”은 제1항과 같이 “동”으로부터 판매방법, 조건 및 판매수수료 규정 등 중요내용에 대해 통지를 받고도 7일 이내에 그 변경내용에 관하여 서면으로 이의를 제기하지 아니한 경우, “행”은 “동”의 통지 내용대로 판매방법, 조건 및 판매수수료 규정 및 기준에 대해 변경하는데 동의한 것으로 본다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제5조 (영업 판매 체결 규정)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       ”행”은 자신의 명의의 회사 운영 시스템(홈페이지 또는 회사 공식 문서 또는 회사 공식 전화 요청)을 통해서만 판매가 진행되어야 “행”이 “동”을 통하지 않고 “제휴사”와 직접 판매 행위가 진행되어서는 아니된다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”은 “동”에게 상품 거래 요청없이 직접 제휴업체와 거래하는 경우 “동”은 “행”의 회원을 강제 탈퇴 조치 할 수 있으며, 이로 발생한 피해한 “동”의 정신적, 경제적 손실은 법적 절차를 거쳐 “행”이 “동”에게 보상해야 한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”이 고객에게 판매한 위탁상품은 고객이 위탁상품의 판매대금 완납 시 판매 완료가 된 것으로 한다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제6조 (판매 수수료의 지급 및 기준)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       ”동”은 매월 1일부터 매월 말일까지 판매에 해당하는 판매수수료 및 보너스 및 시책금 (이하 수수료 등)를 익월 27일에 “행”에게 지급한다. (영업일 기준, 영업일이 휴일인 경우, 익일)
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        판매 수수료 규정 및 상품별 수수료는 “동”의 홈페이지 게시판 또는 문자 또는 기타 방법을 통해 회사 공지사항에 의한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        제1항의 판매 수수료 등은 “행”이 지정하는 수당 계좌에 입금한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        판매수수료는 총 3만원 이상 시 지급하며, 3만원 이하는 누적 처리되고 누적된 수수료가 3만원 이상 시 해당월에 지급한다.
                                                        판매수수료 등은 “행”이 제5조 3항에 따라 “동”에게 판매대금 입금이 완료된 경우 지급한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>5</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        각각 직책에 따른 수수료 규정이 적용된다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>6</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        각 상품별 수수료는 매월 또는 수시 변동될 수 있으며, 공식적으로 매월 회사 전산 시스템에 공지한다. 공지를 하지 않은 경우는 최근 공지 수수료 공지를 기준을 적용한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>7</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        수수료 환불은 제7조(수수료 환불) 규정에 따른다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>8</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        제3항의 판매수수료 등은 판매 수수료 지급 시점 기준, 계약이 유효한 경우에 지급한다
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>9</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”이 탈퇴(강제 또는 본인 직접) 일자 이 후, 어떠한 판매 수수료 및 기타 수수료를 지급하지 아니한다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제7조 (수수료 환불)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       ”행”은 상품 판매 시 고객에게 반드시 약관 규정을 설명하고 청약 철회 절차에 대해 설명해야 한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        상품의 청약대금을 완납한 고객이 위탁 상품을 제공 받기 전에 계약 해지 요청과 환불요청이 발생할 경우, “행”은 기 지급받은 일체 수수료 (프로모션 등 추가 보너스 모두 일체)에 대하여 다음과 같이 “동”에게 환수하기로 한다.
                                                        <ol class="sub_list_ol">
                                                            <li class="list_sub">
                                                                입금액 전액 환불 시 : “행”은 기 수령한 판매 수수료 등 전액
                                                            </li>
                                                            <li class="list_sub">
                                                                입금액 중 일부 환불 시 : 청약금에 대비 환불금의 비율만큼, 동일한 비율의 수수료 등 금액
                                                            </li>
                                                            <li class="list_sub">
                                                                “행”의 수수료 환불 방법 : “동”에게 직접 송금을 우선하며, “동”이 “행”에게 지급할 수수료 등에서 전체 또는 일부 공제하고 지급할 수 있다. 환불 미이행시 지급 명령 신청 또는 수수료 반환 청구 소송 등이 진행될 수 있다
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”이 고객이 구매하기로 한 상품을 보관 중인 경우, 고객이 중대한 민원제기로 인하여 고객으로부터 납입 받은 금액을 환불해야 할 경우, “행”은 기 지급받은 수수료에 대한 책임을 지며, 수수료 환불 절차를 이행하여야 한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”이 본 규정에 따른 업무를 수행함에 있어 본 규정을 위반하거나 약관 설명 등을 소홀히 하여 고객들로부터 환불요청이 있는 경우, 이는 “행”의 전적인 책임으로서 기 수령한 수수료 환불 절차를 이하여야 한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>5</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”이 아래 각호의 1에 해당하는 경우 수수료 등 지급 보류 또는 수당 지급을 하지 않을 수 있다.
                                                        <ol class="sub_list_ol">
                                                            <li class="list_sub">
                                                                “행” 회원 탈퇴로 “동＂에게 속하지 않은 경우
                                                            </li>
                                                            <li class="list_sub">
                                                                법규,지침 또는 영업표준 또는 기타 감독 기관의 지시나 명령에 위배되는 행동을 한 혐의로 사내,외 조사를 받는 경우
                                                            </li>
                                                            <li class="list_sub">
                                                                ”동”이 “행”에게 가압류, 압류, 가처분 또는 소송의 제기 등 민사상 법적절차를 개시하는 경우
                                                            </li>
                                                            <li class="list_sub">
                                                                고객 또는 잠재적 고객이 “동”의 영업행위와 관련하여 “행”에게 가압류,압류, 가처분을 포함한 일체의 소송을 제기하는 경우
                                                            </li>
                                                            <li class="list_sub">
                                                                ”동”이 수당 지급기준 또는 여타 법률에 의거하여 소송 제기 필요가 있거나 소송을 제기한 경우
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>6</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”행”은 제5항에 대해 자기소명을 하고 “동”이 인정한 경우 지급 보류를 중단한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>6</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”동”은 본조에서 정한 수당 지급 제한 또는 보류 조치에 대한 구체적인 기준을 추가로 정하고 변경할 수 있다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제8조 (연간 사용료)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       ”행”이 “동”에게 연간 사용료를 납부한 경우, 유료 회원으로서의 “동” 이 제정한 추가 혜택을 받는다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        연간 사용료 납부 시 혜택 기간은 납부월 미포함하여 익월부터 12개월이다. 혜택은 연간 사용료 납부시 즉시 반영된다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        연간 사용료 환불은 납부 일 기준, 15일 이내 가능하며 이후 에는 환불이 불가능하다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        연간 사용료 환불 시, “행”에게 제공되었던 추가 혜택은 “동＂에게 모두 환불해야 한다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>5</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        제12조 (강제 회원 탈퇴)에 해당하여 중간에 탈퇴된 경우, 연간 사용료는 환불하지 아니한다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제9조 (손해배상 의무)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <li>
                                                       “행”이 본 규정을 위반하거나 기타 “동”의 신용을 훼손하거나 명예를 손상시킴으로써 “동”에게 손해가 발생하였을 경우 “행”은 “동”에게 그 손해를 배상하여야 한다. 이 경우 “동”은 그 손해배상금을 “행”에게 지급할 판매수수료에서 공제할 수 있다.
                                                    </li>
                                                </div>
                                            </div>
                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제10조 (채권양도 금지)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <li>
                                                       본 규정에 의한 “행”의 일체의 권리(판매수수료 등 채권 포함)는 “동”의 사전 서면동의 없이 타인에게 양도하거나 담보로 제공할 수 없다.
                                                    </li>
                                                </div>
                                            </div>
                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제11조 (비밀유지 의무)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       ”행”은 “동”의 내부 중요 정보 등 비밀 유지의 의무가 있다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       ”행”이 고의 또는 과실로 1항을 위반하여 “동＂에게 손해를 끼친 경우에는 민,형사상의 책임을 진다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제12조 (개인정보 보호 및 책임)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-11">
                                                    <li>
                                                       “동”과 “행”은 상호간의 동의 없이 고객 정보 등을 포함한 각각의 당사자와 관련된 어떠한 개인정보도 외부로 유출하지 아니하며 위반시 발생한 손해에 대해서 민,형사상의 책임을 진다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제13조 (회원 강제 탈퇴)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <li>
                                                       “동”은 “행”이 다음 각 호에 해당하는 사유가 발생하는 경우 서면으로 “행”에게 7일 이내(단, 제1 내지 3호의 경우에는 1개월 이내)에 이를 시정할 것을 요구하고, 이 기간 이내에 이를 시정하지 아니할 경우 강제 탈퇴 조치 할 수 있다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        정당한 사유 없이 6개월 이상 매출이 없거나 “동”이 실시 또는 지정한 판매 교육(온/오프라인)에 정당한 사유 없이 참석하지 아니하는 등 본 규정에 따른 위탁판매업의 정상적 이행을 게을리하는 경우
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “행”이 “동”의 승인없이 “동”의 제휴사와 별도의 업무 협의 및 계약 행위 일체를 통해 “동”에게 피해가 발생된 모든 경우
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        기타 “행”의 경영상 사정으로 인하여 더 이상 본 위탁 판매업무를 수행할 수 없다고 판단되는 경우
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        부정 또는 부당한 방법으로 위탁판매를 하거나 기타 행위로 회사의 명예와 신용을 훼손하는 경우
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>5</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “동”에게 납입하여야 할 금원의 인도를 지체, 유용 또는 거절함으로써 “동”에게 손해를 발생시킨 경우
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>6</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        ”동”이 제정한 “상식적 영업 활동과 윤리”에 어긋났다고 판단된 경우
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>7</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “동”의 사전 서면동의 없이 독자적으로 “동”의 브랜드, 상호, 제품명, 법인명의 전부 또는 일부를 사용한 광고 등을 할 경우
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>8</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        30일 이상 연락 두절 등 영업 판매 위탁 업무 달성이 어렵다고 판단되는 경우
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>9</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        회사가 정한 규정, 지침, 지시사항 등을 의도적으로 위반하거나 이에 대한 시정을 요구하였음에도 불구하고 응하지 않는 등 더 이상 위탁 판매가 어렵다고 판단되는 경우
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>10</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        범죄, 허위, 문서위조, 기타 사기행위가 객관적 자료를 통해 입증되거나, 유죄가 확정되는 경우
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>11</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        고의 및 중대한 과실로 위탁 업무 수행과 관련하여 소송 및 민원 등 분쟁으로 인하여 회사에 손해를 발생시킨 경우
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>12</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        비밀유지 위반, 개인정보 보호 위반 등
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>13</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        기타 회사가 지정한 규정 또는 본 규정 이외에 추가로 공지된 규정을 미준수할 경우
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_sub_title">
                                        <b>제14조 (영업 활동 윤리 준수 서약)</b>
                                    </div>
                                    <div class="terms1_details mt-3">
                                        <ol>
                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>1</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                       “행”은 본 규정의 모든 제반 규칙을 준수하고 회사의 윤리 경영에 적극 동참하겠습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>2</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “행”은 신의성실의 원칙에 의한 모든 영업활동을 실천하겠습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>3</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “행”은 직무수행과 관련한 일체의 부조리를 배격하고, 어떠한 부정과 비리행위도 하지 않겠습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>4</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “행”은 “동”의 동의없이 직접 “제휴사”와 일체의 접촉과 개별 영업 활동을 하지 않겠습니다.
                                                    </li>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-1 rmv_width">
                                                    <b><span>5</span></b>
                                                </div>
                                                <div class="col-11">
                                                    <li>
                                                        “행”은 위의 사항을 위반한 경우 이에 상응하는 모든 책임을 감수하겠습니다.
                                                    </li>
                                                </div>
                                            </div>

                                        </ol>
                                    </div>
                                </div>

                                <div class="terms1_content mt-5">
                                    <div class="terms1_details mt-3">
                                        <p>부칙 : 이 규정은 2024년 4월 1일부터 시행합니다.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

        $(document).ready(function() {

            const crurrent_url = window.location.href;
            const url_breck = crurrent_url.split("#");
            const get_name_tab = url_breck[1];

            if(get_name_tab!=undefined)
                $('#pills-tab button[id='+get_name_tab+']').tab('show');
            else
                $('#pills-tab button[id=terms-of-use-tab').tab('show');
        });
    </script>
@endpush
