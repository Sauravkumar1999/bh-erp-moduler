@extends('bhub::sales.master',['title'=>'개인정보 수집 및 제 3자 제공 동의'])
@section('css')
    <link rel="stylesheet" href="{{ themes('css/bh-consent.css') }}">
@endsection

@section('content')
    @include('bhub::sales.partials._nav')
        <div id="bh-consent">
            <!-- ======= Banner ======= -->
            <div id="consent_banner" class="d-flex align-items-center justify-content-center">
                <div class="col-md-5 text-md-end ">
                    <h2 class="fw-bold main_title"> 개인정보 수집 및 제 3자 제공 동의 </h2>
                </div>
                <div class="col-md-7 text-end text-md-center imageBox">
                    <picture>
                        <source srcset="sourceset" type="image" />
                        <img src="{{ themes('images/bh-auto/car.png') }}" class="img-fluid car" alt="image desc" />
                    </picture>
                    <picture>
                        <source srcset="sourceset" type="image" />
                        <img src="{{ themes('images/bh-auto/logo.png') }}" class="img-fluid logo" alt="image desc" />
                    </picture>

                </div>

            </div>
        </div>
        <section id="details">
            <div class="container">
                <div class=" custom-consent">
                    <div class="text-center text-title text-nowrap">개인정보 수집 및 제 3자 제공 동의</div>
                </div>

                <!-- ======= Form  ======= -->
                <div class="form-wrapper ">
                    <div class="custom-consent-card " >
                        <div class="row d-flex gap-2">
                            <div class=" ">주식회사 비즈니스허브 및 오토플래너㈜ (이하 ＂회사＂라 합니다)는 개인정보보호법, 위치정보의 보호 및 이용 등에 관한 법률 등 관련법령에 따라 이용자의 개인정보 및 위치정보 보호 및 권익을 보호하고 개인정보 및 위치정보와 관련한 이용자의 제8조 고충을 원활하게 처리할 수 있도록 다음과 같은 처리 방침을 두고 있습니다. 회사는 개인정보처리방침을 개정하는 경우 웹사이트 공지사항(또는 개별공지)을 통하여 공지할 것입니다.</div>
                            <div class="consent-heading pt-4">제 1 조 (기본 원칙)</div>
                            <div class=" ">회사는 정보통신망 이용촉진 및 정보보호 등에 관한 법률, 통신비밀보호법, 전기통신사업법, 개인정보보호법 등 정보통신서비스제공자가 준수하여야 할 관련 법령상의 개인정보보호 규정을 준수하며, 관련 법령에 의거한 개인정보 처리방침을 정하여 회원 권익 보호에 최선을 다하고 있습니다.</div>
                            <div class="consent-heading pt-4">제 2 조 (회사가 수집하는 개인정보)</div>
                            <div class=" ">회사는 서비스 제공을 위하여 다음의 개인 정보를 수집하고 있습니다.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="cards">
            <div class="container">
                <div class="d-flex  flex-column flex-md-row align-items-center justify-content-center" style="gap: 48px !important">
                    <div class="custom-collection-card">
                        <div class="consent-container">
                            <div class="consent-text">수집 목적</div>
                        </div>

                        <div class="consent-container-alt  d-flex align-items-center">
                            <div class="w-100 px-4">장기렌터카, 리스, 할부 등 견적상담</div>
                        </div>

                        <div class="consent-container-alt   d-flex align-items-center">
                            <div class="w-100 px-4">서비스 제공에 관한 계약이행</div>
                        </div>

                        <div class="consent-container-alt  d-flex align-items-center">
                            <div class="w-100 px-4">회사의 견적신청, 견적회신 및 상담, 장기대여 계약의 체결/이행/관리</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">광고, 이벤트 및 프로모션</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">고충처리 및 컴플레인 관리</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">렌터카 및 리스 할부 계약 진행 및 체결</div>
                        </div>

                    </div>

                    <div class="custom-collection-card">
                        <div class="consent-container">
                            <div class="consent-text">수집 항목</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">이름, 성별, 휴대전화번호, 생년월일, 주소, 운전면허번호, 이메일주소</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">이름, 성별, 휴대전화번호, 생년월일, 주소, 운전면허번호, 이메일주소</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">이름, 성별, 휴대전화번호, 생년월일, 주소, 운전면허번호, 이메일주소</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">이름, 성별, 휴대전화번호, 생년월일, 주소, 운전면허번호, 이메일주소</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">이름, 성별, 휴대전화번호, 생년월일, 주소, 운전면허번호, 이메일주소</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">성별, 연락처, 이메일주소, 운전면허번호</div>
                        </div>

                    </div>

                    <div class="custom-collection-card">
                        <div class="consent-container">
                            <div class="consent-text">보유 기간</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">서비스 공급 완료 및 계약 완료시로부터 5년</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">서비스 공급 완료 및 계약 완료시로부터 5년</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">서비스 공급 완료 및 계약 완료시로부터 5년</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">동의일로부터 5년</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">동의일로부터 5년</div>
                        </div>

                        <div class="consent-container-alt d-flex align-items-center">
                            <div class="w-100 px-4">계약 종료후 5년</div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="text-container">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center form-wrapper ">
                    <div class="custom-consent-card" >
                        <div class="row mb-5">
                            <p class="consent-heading mb-3">제 3 조 (서비스 이용 시 수집하는 개인정보)</p>
                            <p class=" ">서비스 이용과정에서 추가로 생성되는 다음의 회원의 정보들을 수집할 수 있습니다.</p>
                            <p class=" ">■IP주소, 쿠키, 기기식별번호, 서비스 이용 기록, 방문 기록, 접속 로그, 불량 이용 기록 등 정보.</p>
                            <p class="consent-heading mb-3">제 4 조 (민감한 개인정보의 수집 금지 등)</p>
                            <p class=" ">회사는 회원의 기본적 인권 침해의 우려가 있는 민감한 개인정보(인종, 사상, 신조, 정치적 성향, 범죄기록, 의료정보 등)는 수집하지 않으며, 회원이 선택 항목의 정보를 입력하지 않은 경우에도 회사가 제공하는 서비스 이용에 제한은 없습니다.</p>
                            <p class="consent-heading mb-3">제 5 조 (개인정보 수집 방법)</p>
                            <p class=" ">회사는 다음 각 호의 방법으로 개인정보를 수집합니다.</p>
                            <p class=" ">(1)회사 웹사이트, 앱, 서면 양식, 전화/팩스 등 서비스 가입이나 사용 중 회원의 자발적 제공을 통한 수집</p>
                            <p class=" ">(2)생성 정보 수집 툴을 통한 수집</p>
                            <p class="consent-heading mb-3">제 6 조 (개인정보 수집 및 이용 목적)</p>
                            <p class=" ">회사는 다음 각 호의 목적으로 회원의 개인정보를 수집 및 이용합니다. 수집한 개인정보는 다음의 목적 이외의 용도로 사용되지 않으며 이용 목적이 변경될 시에는 별도의 사전동의를 구합니다.</p>
                            <p class=" ">(1)회원가입 및 관리 : 회원 가입의사 확인, 회원제 서비스 제공에 따른 본인 식별·인증, 회원자격 유지·관리, 제한적 본인 확인제 시행에 따른 본인확인, 서비스 부정이용 방지,
                            각종 고지·통지, 고충처리, 분쟁 조정을 위한 기록 보존 등의 목적</p>
                            <p class=" ">
                                (2)민원사무의 처리 : 민원인의 신원 확인, 민원사항 확인, 사실조사를 위한 연락·통지, 처리결과 통보 등의 목적
                            </p>
                            <p class=" ">
                                (3)서비스의 제공 : 서비스 제공, 본인 인증, 연령 인증 등의 목적
                            </p>
                            <p class=" ">
                            (4)마케팅 및 광고에의 활용 : 신규 서비스 개발 및 맞춤 서비스 제공, 이벤트 및 광고성 정보 제공 및 참여기회 제공, 인구통계학적 특성에 따른 서비스 제공 및 광고 게재, 서비스의 유효성 확인, 접속빈도 파악 또는 회원의 서비스 이용에 대한 통계 등을 목적으로 개인정보를 처리합니다.
                            </p>
                            <p class="consent-heading mb-3">제 7 조 (개인정보 제3자 제공의 기본 원칙)</p>
                            <p class=" ">
                            회사는 회원들의 개인정보를 제6조에 고지한 범위 내에서 사용하며, 회원의 사전 동의 없이는 동 범위를 초과하여 이용하거나 원칙적으로 회원의 개인정보를 제3자에
                            </p>
                            <p class=" ">
                            제공하거나 외부에 공개하지 않습니다. 다만, 다음 각 호의 경우는 예외로 합니다.
                            </p>
                            <p class=" ">
                            (1)이용자들이 사전에 공개에 동의한 경우
                            </p>
                            <p class=" ">
                            (2)법령의 규정에 의거하거나, 수사 목적으로 법령에 정해진 절차와 방법에 따라 수사기관의 요구가 있는 경우
                            </p>
                            <p class=" ">
                            (3)통계작성, 학술연구 또는 시장조사를 위하여 필요한 경우로서 특정 개인을 식별할 수 없는 형태로 제공하는 경우
                            </p>


                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section class="text-container">
            <div class="container">
                <div class="row gap-mobile">
                    <div class="col-md-3 ">
                        <div class="consent-content">

                            <div class="consent-recipient-title">
                                <div class="text-center text-white consent-text">제공 받는자</div>
                            </div>
                            <div class="empty"> </div>
                            <div class="mt-2 p-3 .custom-card-height">

                                <ul>
                                    <li>오토플래너㈜</li>
                                    <li>하나캐피탈</li>
                                    <li>KB캐피탈</li>
                                    <li>신한캐피탈</li>
                                    <li>JB캐피탈</li>
                                    <li>DGB캐피탈</li>
                                    <li>NH농협캐피탈</li>
                                    <li>롯데캐피탈</li>
                                    <li>메리츠캐피탈</li>
                                    <li>BNK캐피탈</li>
                                    <li>현대캐피탈</li>
                                    <li>우리금융</li>
                                    <li>우리카드</li>
                                    <li>삼성카드</li>
                                    <li>KDB산은 캐피탈</li>
                                    <li>미레에셋 캐피탈</li>
                                    <li>롯데 오토리스</li>
                                    <li>롯데 렌터카</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="consent-content">
                            <div class=" mb-4 consent-recipient">
                                <div class=" consent-recipient-title">
                                    <div class="text-center text-white consent-text">제공 목적</div>
                                </div>
                                <div class="empty"> </div>
                                <div class=" mt-2 custom-card-height">
                                    <div class="p-3">장기렌트, 리스, 할부 견적시청 및 상담, 장기<br/>대여 계약의 체결, 이행, 관리, 신청서비스<br/>제공, 본인여부확인, 분쟁 및 민원처리</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="consent-content">
                            <div class=" mb-4 consent-recipient">
                                <div class="consent-recipient-title">
                                    <div class="text-center text-white consent-text">제공 항목</div>
                                </div>
                                <div class="empty"> </div>

                                <div class="mt-2 custom-card-height">
                                    <div class="p-3">이름, 휴대전화번호, 생년월일, 주소,<br/>운전면허번호, 성별, 이메일주소</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="consent-content">
                            <div class="mb-2 consent-recipient">
                                <div class="consent-recipient-title">
                                    <div class="text-center text-white consent-text">제공 기간</div>
                                </div>
                                <div class="empty"> </div>

                                <div class="mt-2 custom-card-height">
                                    <div class="p-3">제3자 정보 제공 동의 철회 시 또는 제휴<br/>계약 종료 시까지</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <div class="container text-container" style="margin-bottom:60px;">
            <div class="custom-consent-card" >
                <div class="row">
                    <div class="consent-heading mb-2">제 9 조 (개인정보의 취급 위탁)</div>
                    <p class=" ">회사는 이용자에게 다양한 서비스를 제공하는 데에 반드시 필요한 업무 중 일부를 외부 업체로 하여금 수행하도록 개인정보를 위탁하고 있습니다. 그리고 위탁 받은 업체가 개인정보보호 관계 법령을 위반하지 않도록 관리·감독하고 있습니다.</p>
                </div>
            </div>
        </div>

        <div class="container text-container" style="margin-bottom:60px;">
            <div class="row gap-mobile">
                <div class="col-md-4 col-sm-12 ">
                    <div class="consent-content">
                        <div class="consent-recipient-title">
                            <div class="text-center text-white consent-text">위탁업무내용</div>
                        </div>
                        <div class="empty"> </div>

                        <div class="mt-2 p-4 custom-card-2-height">
                            <p>SMS발송업무</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 ">
                    <div class="consent-content">
                        <div class="consent-recipient">
                            <div class=" consent-recipient-title">
                                <div class="text-center text-white consent-text">수탁업체</div>
                            </div>
                            <div class="empty"> </div>

                            <div class=" mt-2  p-4 custom-card-2-height">
                            <ul>
                                <li>세종텔레콤</li>
                                <li>(주)에스엠티엔티</li>
                                <li>LG텔레콤</li>
                                <li>SK텔레콤SP</li>
                                <li>KT텔레콤</li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 ">
                    <div class="consent-content">
                        <div class=" consent-recipient">
                            <div class="consent-recipient-title">
                                <div class="text-center text-white consent-text">개인정보의 보유 및 이용기간</div>
                            </div>
                            <div class="empty"> </div>

                            <div class="mt-2 p-4 custom-card-2-height">

                            <p>
                                회원탈퇴시 혹은 위탁계약 종료시까지
                            </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-container" style="margin-bottom: 120px;">
            <div class="">
                <div class="custom-consent-card" >
                    <div class="row  mb-5">
                        <p class="consent-heading">제 10 조 (개인정보 보유 및 이용기간의 기본 원칙)</p>
                        <p class=" ">원칙적으로 회원의 개인정보는 개인정보의 수집 및 이용목적이 달성되면 지체 없이 파기됩니다.</p>
                    </div>

                    <div class="row  mb-5">
                        <p class="consent-heading mb-2">제 11 조 (관련 법령에 의한 개인정보의 보유)</p>
                        <p class=" ">회사는 상법, 전자상거래 등에서의 소비자보호에 관한 법률 등 관계법령의 규정에 의하여 다음 각 호에 따라 회원의 해당 개인정보를 보관하며, 그 목적의 범위 내에서만 이를  이용합니다. 단, 회사 이용계약에 의해 이용계약이 존속 중인 회원(탈퇴하지 아니한 회원)의 경우 보관기간은 보존의무기간 이상 보관할 수 있으며, 해당 기간이 경과된 기록에 대해서는 회원의 삭제 요청이 있는 경우 파기합니다.</p>
                        <p class=" ">(1)계약 또는 청약철회 등에 관한 기록 : 전자상거래 등에서의 소비자보호에 관한 법률에 따라 5년간 보존</p>
                        <p class=" ">(2)대금결제 및 재화 등의 공급에 관한 기록 : 전자상거래 등에서의 소비자보호에 관한 법률에 따라 5년간 보존</p>
                        <p class=" ">(3)소비자의 불만 또는 분쟁 처리에 관한 기록 : 전자상거래 등에서의 소비자보호에 관한 법률에 따라 3년간 보존</p>
                        <p class=" ">(4)표시·광고에 관한 기록 : 전자상거래 등에서의 소비자보호에 관한 법률에 따라 6개월간 보존</p>
                        <p class=" ">(5)본인확인에 관한 기록 : 정보통신망 이용촉진 및 정보보호 등에 관한 법률에 따라 6개월간 보존</p>
                        <p class=" ">(6)전기통신일시, 개시·종료시간, 가입자 번호, 사용 도수, 발신 기지국 위치추적자료에 관한 기록 : 통신비밀보호법에 따라 1년간 보존</p>
                        <p class=" ">(7)컴퓨터통신, 인터넷 로그기록자료, 접속지 추적 자료 : 통신비밀보호법에 따라 3개월간 보존</p>
                        <p class=" ">(8)신용정보의 수집/처리 및 이용 등에 관한 기록 : 3년</p>
                    </div>

                    <div class="row  mb-5">
                        <p class="consent-heading mb-2">제 12 조 (개인정보의 파기 절차 및 방법)</p>
                        <p class=" ">회사는 원칙적으로 개인정보 이용 목적이 달성된 경우에는 파기 사유가 발생한 개인정보를 선정하고, 회사의 개인정보 보호책임자의 승인을 받아 지체 없이 해당 개인정보를   파기하며 파기의 절차, 기한 및 방법은 다음과 같습니다.</p>
                        <p class=" ">(1)파기 절차 : 이용자가 입력한 정보는 목적 달성 후 별도의 DB에 옮겨져(종이의 경우 별도의 서류) 내부 방침 및 기타 관련 법령에 따라 일정기간 저장된 후 혹은 즉시 파기됩니다. 이 때, DB로 옮겨진 개인정보는 법률에 의한 경우가 아니고서는 다른 목적으로 이용되지 않습니다.</p>
                        <p class=" ">(2)파기 기한 : 이용자의 개인정보는 개인정보의 보유기간이 경과된 경우에는 보유기간의 종료일로부터 5일 이내에, 개인정보의 이용 목적 달성, 해당 서비스의 폐지, 사업의 종료 등 그 개인정보가 불필요하게 되었을 때에는 개인정보의 처리가 불필요한 것으로 인정되는 날로부터 5일 이내에 그 개인정보를 파기합니다.</p>
                        <p class=" ">(3)파기 방법 : 종이에 기록, 저장된 개인정보는 분쇄기로 분쇄하거나 소각을 통하여 파기하며, 전자적 파일 형태로 저장된 개인정보는 기록을 재생할 수 없도록 기술적 방법을 사용하여 삭제합니다.</p>
                    </div>

                    <div class="row  mb-5">
                        <p class="consent-heading mb-2">제 13 조 (개인정보의 수집, 이용, 제공에 대한 동의 철회)</p>
                        <p class=" ">회원은 회원 가입 등을 통해 개인정보의 수집, 이용, 제공에 대하여 동의한 내용을 언제든지 철회할 수 있습니다.</p>
                    </div>

                    <div class="row  mb-5">
                        <p class="consent-heading mb-2">제 14 조 (회원의 권리와 행사방법)</p>
                        <p class=" ">(1)회원은 회사에 대해 언제든지 다음과 각 호와 같은 권리를 행사할 수 있습니다.</p>
                        <p class=" ">■개인정보 열람 요구</p>
                        <p class=" ">■오류 등이 있을 경우 정정 요구</p>
                        <p class=" ">■삭제 요구</p>
                        <p class=" ">■처리 정지 요구</p>
                        <p class=" ">(2)제1항에 따른 권리 행사는 회사에 대해 개인정보 보호법 시행규칙 별지 제8호 서식에 따라 서면, 전자우편, 등을 통하여 하실 수 있으며 회사는 본인 확인을 위한 요청인의   신분증 사본 등의 증표를 제시 받아 해당 요구가 진정한 본인의 의사인지 여부를 확인할 수 있으며, 본인으로 확인되고 개인정보에 오류가 있거나 보존기간을 경과한 것이 판명되는 등 정정 또는 삭제할 필요가 있다고 인정되는 경우 지체 없이 그에 따른 조치를 취합니다.</p>
                        <p class=" ">(3)회원이 개인정보의 오류 등에 대한 정정 또는 삭제를 요구한 경우에는 회사는 정정 또는 삭제를 완료할 때까지 당해 개인정보를 이용하거나 제공하지 않습니다. 제1항에 따른 권리 행사는 회원의 법정대리인이나 위임을 받은 자 등 대리인을 통하여 하실 수 있습니다. 이 경우 개인정보 보호법 시행규칙 별지 제11호 서식에 따른 위임장을 제출하여야   합니다.</p>

                    </div>

                    <div class="row  mb-5">
                        <p class="consent-heading mb-2">제 15 조 (회사의 개인정보 열람 및 이용 제한)</p>
                        <p class=" ">(1)회원 또는 법정대리인의 요청에 의해 해지 또는 삭제, 정정된 개인정보는 제10조 내지 제12조에 명시된 바에 따라 처리되고, 그 외의 용도로 열람 또는 이용할 수 없도록 처리하고 있습니다.</p>
                        <p class=" ">(2)회원 및 법정 대리인은 언제든지 등록되어 있는 자신 혹은 당해 만 14세 미만 아동의 개인정보를 조회하거나 수정할 수 있으며 가입 해지를 요청할 수도 있습니다.</p>
                    </div>

                    <div class="row mb-5">
                        <p class="consent-heading mb-2">제 16 조 (쿠키의 운용)</p>
                        <p class=" ">(1)회사는 회원에게 특화된 맞춤서비스를 제공하기 위해서 회원들의 정보를 수시로 저장하고 찾아내는 '쿠키(cookie)' 등을 운용합니다. 쿠키란 웹사이트를 운영하는 데 이용되는 서버가 회원의 브라우저에 보내는 아주 작은 텍스트 파일로서 회원의 컴퓨터 하드디스크에 저장되기도 합니다.</p>
                        <p class=" ">(2)회사는 회원과 비회원의 접속 빈도나 방문 시간 등을 분석, 회원의 취향과 관심분야를 파악 및 자취 추적, 각종 이벤트 참여 정도 및 방문 횟수 파악 등을 통한 타깃 마케팅 및 개인 맞춤 서비스 제공 등의 목적으로 쿠키를 사용합니다.</p>
                        <p class=" ">(3)회원은 쿠키 설치에 대한 선택권을 가지고 있습니다. 따라서, 회원은 웹 브라우저에서 옵션을 설정함으로써 모든 쿠키를 허용하거나, 쿠키가 저장될 때마다 확인을 거치거나, 아니면 모든 쿠키의 저장을 거부할 수도 있습니다.</p>
                        <p class=" ">(4)제3항에 따라 쿠키 설정을 거부하는 방법으로, 회원은 사용하는 웹 브라우저의 옵션을 선택함으로써 모든 쿠키를 허용하거나 쿠키를 저장할 때마다 확인을 거치거나, 모든 쿠키의 저장을 거부할 수 있습니다. 크롬의 경우를 예로 들면, 웹 브라우저 상단 우측의 설정 > 개인정보 및 보안 > 개인정보 및 보안 메뉴를 통하여 쿠키 설정의 거부가 가능합니다.</p>
                        <p class=" ">(5)회원이 쿠키 설치를 거부하는 경우 로그인이 필요한 일부 서비스 이용에 어려움이 있을 수 있습니다.</p>
                    </div>


                    <div class="row mb-5">
                        <p class="consent-heading mb-2">제 17 조 (해킹 등에 대비한 대책)</p>
                        <p class=" ">회사는 개인정보보호법 제29조에 따라 다음과 같이 안전성 확보에 필요한 기술적/관리적 및 물리적 조치를 하고 있습니다.</p>
                        <p class=" ">(1)개인정보 취급 직원의 최소화 및 교육 : 개인정보를 취급하는 직원을 지정하고 담당자에 한정시켜 최소화 하여 개인정보를 관리하는 대책을 시행하고 있습니다.</p>
                        <p class=" ">(2)정기적인 자체 감사 실시 : 개인정보 취급 관련 안정성 확보를 위해 정기적(분기 1회)으로 자체 감사를 실시하고 있습니다.</p>
                        <p class=" ">(3)내부관리계획의 수립 및 시행 : 개인정보의 안전한 처리를 위하여 내부관리계획을 수립하고 시행하고 있습니다.</p>
                        <p class=" ">(4)개인정보의 암호화 : 이용자의 개인정보는 비밀번호는 암호화 되어 저장 및 관리되고 있어, 본인만이 알 수 있으며 중요한 데이터는 파일 및 전송 데이터를 암호화 하거나    파일 잠금 기능을 사용하는 등의 별도 보안기능을 사용하고 있습니다.</p>
                        <p class=" ">(5)해킹 등에 대비한 기술적 대책 : 회사는 해킹이나 컴퓨터 바이러스 등에 의한 개인정보 유출 및 훼손을 막기 위하여 보안프로그램을 설치하고 주기적인 갱신·점검을 하며 외부로부터 접근이 통제된 구역에 시스템을 설치하고 기술적/물리적으로 감시 및 차단하고 있습니다.</p>
                        <p class=" ">(6)개인정보에 대한 접근 제한 : 개인정보를 처리하는 데이터베이스시스템에 대한 접근 권한의 부여, 변경, 말소를 통하여 개인정보에 대한 접근통제를 위하여 필요한 조치를   하고 있으며 침입차단시스템을 이용하여 외부로부터의 무단 접근을 통제하고 있습니다.</p>
                        <p class=" ">(7)접속 기록의 보관 및 위변조 방지 : 개인정보처리시스템에 접속한 기록을 최소 6개월 이상 보관, 관리하고 있으며, 접속 기록이 위변조 및 도난, 분실되지 않도록 보안기능    사용하고 있습니다.</p>
                        <p class=" ">(8)문서보안을 위한 잠금 장치 사용 : 개인정보가 포함된 서류, 보조저장매체 등을 잠금 장치가 있는 안전한 장소에 보관하고 있습니다.</p>
                        <p class=" ">(9)비인가자에 대한 출입 통제 : 개인정보를 보관하고 있는 물리적 보관 장소를 별도로 두고 이에 대해 출입통제 절차를 수립, 운영하고 있습니다.</p>
                    </div>

                    <div class="row mb-5">
                        <p class="consent-heading mb-3">제 18 조 (취급 직원의 최소화 및 교육)</p>
                        <p class=" ">회사의 개인정보 관련 취급 직원은 담당자에 한정시키고 있고 이를 위한 별도의 비밀번호를 부여하여 정기적으로 갱신하고 있으며, 담당자에 대한 수시 교육을 통하여 회사는  개인정보 처리방침의 준수를 항상 강조하고 있습니다.</p>
                        <p class=" ">제 19 조 (개인정보관리 책임자 및 담당자)</p>
                        <p class=" ">회원은 회사의 서비스를 이용하시며 발생하는 모든 개인정보보호에 대한 문의, 불만처리, 피해구제 등 관련 민원을 다음 각 호의 개인정보보호책임자 혹은 담당부서로 신고하실 수 있습니다. 회사는 정보주체의 문의에 대해 지체 없이 답변 및 처리해드릴 것입니다.</p>
                        <p class=" ">[개인정보 보호 책임자]</p>
                        <p class=" ">■이름 : 김병욱</p>
                        <p class=" ">■직책 : 부대표</p>
                        <p class=" ">■연락처 : {{ setting('bh_telephone', '') }}</p>
                        <p class=" ">기타 개인정보침해에 대한 신고나 상담이 필요하신 경우에는 아래 기관에 문의하실 수 있습니다.</p>
                        <p class=" ">- 개인정보침해신고센터 (privacy.kisa.or.kr / 국번없이 118)</p>
                        <p class=" ">- 대검찰청 사이버수사과 (www.spo.go.kr / 국번없이 1301)</p>
                        <p class=" ">- 경찰청 사이버안전국 (www.police.go.kr / 국번없이 182)</p>
                        <p class=" ">(1)회사는 현행 개인정보 처리방침에 대한 내용 추가, 삭제 및 수정이 있을 시에는 개정 최소 7일 전부터 플랫폼을 통해 변경 이유 및 그 내용을 고지합니다. 다만, 개인정보의    수집 및 활용 등에 있어 이용자 권리의 중요한 변경이 있을 경우에는 최소 30일 전에 고지합니다.</p>
                        <p class=" ">(2)회사는 회원이 동의한 범위를 넘어 회원의 개인정보를 이용하거나 제3자에게 취급위탁하기 위해 회원의 추가적인 동의를 얻고자 하는 때에는 미리 회원에게 개별적으로    서면, 전자우편, 전화 등으로 해당사항을 고지합니다.</p>
                        <p class=" ">(3)회사는 개인정보의 수집, 보관, 처리, 이용, 제공, 관리, 파기 등을 제3자에게 위탁하는 경우에는 개인정보 처리방침 등을 통하여 그 사실을 회원에게 고지합니다.</p>
                        <p class=" ">[부칙]</p>
                        <p class=" ">본 개인정보처리방침은 2023년 12월 1일부터 시행됩니다.</p>

                    </div>
                </div>
            </div>
        </div>

@endsection
@section('js')
@endsection
