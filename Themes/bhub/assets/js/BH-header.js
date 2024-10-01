// Define the header component
const headerComponent = `
    <div class = "header">
        <div class="first-container">
            <h6><img src="./assets/images/cell-icon.png" /> {{ setting('bh_telephone', '') }}</h6>
        </div>
        <div class="navbar">
            <div class="navbar-container">
                <div class="second-container"> 
                    <div class="logo">
                            <img src="./assets/images/myhublogo.png" 
                            alt="48pay-logo" />
                    </div>

                    <div class="content-middle">
                        <div class="dropdown">
                            <h5>My HUB<img src="./assets/images/keydown.png"></h5>
                            <div class="dropdown-content">
                            <h6>인사말</h6>
                            <h6>비즈니스 모델</h6>
                            <h6>“My HUB” 경쟁력</h6>
                            <h6>지사대표(BP)란?</h6>
                            <h6>지사대표 등록과정</h6>
                            <h6>구조 및 보상</h6>
                            <h6>“My HUB” 앱 설치</h6>
                            </div>
                        </div>
                        <div class="col-b" id="tab-2"><h5>세일즈 아이템</h5></div>
                        <div class="col-c" id="tab-3"><h5>My 아카데미</h5></div>
                        <div class="dropdown">
                            <h5>고객센터<img src="./assets/images/keydown.png"></h5>
                            <div class="dropdown-content-2">
                            <h6>월간뉴스</h6>
                            <h6>자주하는 질문 (FAQ)</h6>
                            <h6>이용 안내 및 문의</h6>
                            <h6>오시는 길</h6>
                            </div>
                        </div>
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



document.querySelectorAll('.dropdown-content h6').forEach(item => {
    item.addEventListener('click', function() {
        const text = this.textContent.trim();

        switch (text) {
            case '인사말':
                window.location.href = './Greetings.html';
                break;
            case '비즈니스 모델':
                window.location.href = './BusinessModel.html';
                break;
            case '“My HUB” 경쟁력':
                window.location.href = './Competitiveness.html';
                break;
            case '지사대표(BP)란?':
                window.location.href = './BranchRepresentative.html';
                break;
            case '지사대표 등록과정':
                window.location.href = './RegistrationProcess.html';
                break;
            case '구조 및 보상':
                window.location.href = './CompensationPage.html';
                break;
            case '“My HUB” 앱 설치':
                window.location.href = './InstallApp.html';
                break;
            default:
                window.location.href = './Greetings.html';
                break;
        }
    });
});

document.querySelectorAll('.dropdown-content-2 h6').forEach(item => {
    item.addEventListener('click', function() {
        const text = this.textContent.trim();

        switch (text) {
            case '월간뉴스':
                window.location.href = './MonthlyNews.html';
                break;
            case '자주하는 질문 (FAQ)':
                window.location.href = './FAQ.html';
                break;
            case '이용 안내 및 문의':
                window.location.href = './Instructions.html';
                break;
            case '오시는 길':
                window.location.href = './WayToCome.html';
                break;
            default:
                window.location.href = './MonthlyNews.html';
                break;
        }
    });
});
