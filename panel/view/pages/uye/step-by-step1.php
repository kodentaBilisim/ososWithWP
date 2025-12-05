<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">OTOMATİK AİDAT TALİMATI</h4></div>
            </div>

        </div>
        <div class="row">

            <div class="col-12">


                <form id="signupForm" action="http://localhost:3000/post" method="POST">

                    <!-- 1. Adım - Kullanıcı Sözleşmesi -->
                    <div class="step active" id="step1">
                        <h3>Kullanıcı Sözleşmesi</h3>
                        <p>
                            Lütfen aşağıdaki kullanıcı sözleşmesini okuyun ve kabul edin:
                        </p>
                        <textarea rows="6" style="width: 100%;" readonly>
                Buraya kullanıcı sözleşmesini ekleyin.
            </textarea><br><br>
                        <label>
                            <input type="checkbox" id="agree" required> Sözleşmeyi kabul ediyorum
                        </label><br>
                        <div class="button">
                            <button type="button" onclick="nextStep(1)">Devam Et</button>
                        </div>
                    </div>

                    <!-- 2. Adım - Kişisel Bilgiler -->
                    <div class="step" id="step2">
                        <h3>Kişisel Bilgiler</h3>
                        <label for="name">İsim Soyisim:</label><br>
                        <input type="text" id="name" name="name" required><br><br>
                        <label for="email">E-posta:</label><br>
                        <input type="email" id="email" name="email" required><br><br>
                        <label for="phone">Telefon:</label><br>
                        <input type="tel" id="phone" name="phone" required><br><br>
                        <div class="button">
                            <button type="button" onclick="previousStep(1)">Geri</button>
                            <button type="button" onclick="nextStep(2)">Devam Et</button>
                        </div>
                    </div>

                    <!-- 3. Adım - Kredi Kartı Bilgileri -->
                    <div class="step" id="step3">
                        <h3>Kredi Kartı Bilgileri</h3>
                        <label for="cardnumber">Kart Numarası:</label><br>
                        <input type="text" id="cardnumber" name="cardnumber" required><br><br>
                        <label for="expirydate">Son Kullanma Tarihi:</label><br>
                        <input type="text" id="expirydate" name="expirydate" placeholder="MM/YY" required><br><br>
                        <label for="cvv">CVV:</label><br>
                        <input type="text" id="cvv" name="cvv" required><br><br>
                        <div class="button">
                            <button type="button" onclick="previousStep(2)">Geri</button>
                            <button type="submit">Gönder</button>
                        </div>
                    </div>

                </form>

                <script>
                    let currentStep = 1;

                    function showStep(step) {
                        document.querySelectorAll('.step').forEach((el, index) => {
                            if (index + 1 === step) {
                                el.classList.add('active');
                            } else {
                                el.classList.remove('active');
                            }
                        });
                    }

                    function nextStep(step) {
                        if (step === 1 && !document.getElementById('agree').checked) {
                            alert("Lütfen sözleşmeyi kabul edin.");
                            return;
                        }
                        currentStep++;
                        showStep(currentStep);
                    }

                    function previousStep(step) {
                        currentStep--;
                        showStep(currentStep);
                    }
                </script>

                <style>

                    .step {
                        display: none;
                    }
                    .step.active {
                        display: block;
                    }
                    .button {
                        margin-top: 10px;
                    }
                    .button button {
                        padding: 10px 20px;
                        cursor: pointer;
                    }
                </style>


            </div>
        </div>
    </div>
</div>

