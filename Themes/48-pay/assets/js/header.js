// Define the header component
const headerComponent = `
    <div class="header">
        <div class="button-container">
            <div class="container-inner">
                <div class="logo">
                        <img src="./assets/images/48pay-logo.png"
                        alt="48pay-logo" />
                </div>

                <div class="content-text">
                    <div class="col-a" id="tab-1"><h5>48개월 초슬림할부</h5></div>
                    <div class="col-b" id="tab-2"><h5>결제 구조</h5></div>
                    <div class="col-c" id="tab-3"><h5>가맹 절차</h5></div>
                </div>

                <div class="buttons">
                    <button type="button" class="btn btn-outline-secondary" id="button-1"><b>가맹 상담 신청</b ></button>
                    <button type="button" class="btn btn-outline-secondary" id="button-2"><b>가맹 도우미</b></button>
                </div>
            </div>
        </div>
    </div>
`;

// Append the header component to the #header-container
document.getElementById('header-container').innerHTML = headerComponent;
