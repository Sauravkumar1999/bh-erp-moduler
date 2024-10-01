// Define the header component
const headerComponent = `
    <div class = "header">
        <div class="first-container">
            <h6><img src="{{ asset('assets/images/cell-icon.png') }}" /> {{ setting('bh_telephone', '') }}</h6>
        </div>
        <div class="navbar">
            <div class="navbar-container">
                <div class="second-container">
                    <div class="logo">
                            <img src="{{ asset('assets/images/myhublogo.png') }}"
                            alt="48pay-logo" />
                    </div>

                    <div class="content-middle">
                        <div class="col-a" id="tab-1"><h5>My HUB<img src="{{ asset('assets/images/keydown.png') }}"></h5></div>
                        <div class="col-b" id="tab-2"><h5>세일즈 아이템</h5></div>
                        <div class="col-c" id="tab-3"><h5>My 아카데미</h5></div>
                        <div class="col-d" id="tab-4"><h5>고객센터<img src="{{ asset('assets/images/keydown.png') }}"></h5></div>
                        <div class="col-e" id="tab-5"><h5>지사대표 모집</h5></div>
                    </div>

                    <div class="button">
                        <button type="button" class="btn btn-primary" id="button-1"><b>로그인</b ></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
`;

// Append the header component to the #header-container
document.getElementById('header-container').innerHTML = headerComponent;
