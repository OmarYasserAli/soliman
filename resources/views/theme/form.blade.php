<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
  <title>سجل اهتمامك</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="https://alsoliman.com.sa/theme/images/logo.svg">
  <link rel="stylesheet" href="{{ asset('form_assets/css/bootstrap.min.css') }}">
  <script src="{{ asset('form_assets/js/bootstrap.bundle.min.js') }} "></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<link href="https://db.onlinewebfonts.com/c/a85976799f11330f194b1dc04c954666?family=Bahij+TheSansArabic+Plain" rel="stylesheet">


<style>

@font-face {
  font-family: 'Alsolimanfont'; /* Choose a name for your font */
  src: local('Alsolimanfont'),  url('../../form_assets/font/bahij-thesansarabic-semibold.ttf') format('truetype'); /* Specify the font file and its format */
}

* {
  font-family: 'Alsolimanfont', sans-serif; /* Use the font-family you defined in @font-face */
}
     .iti {
        position: relative;
         display: block;
    }
    .form-control {
      border: 1px solid gray;
    }
        .nav-link {

         display: inline;
        padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
        font-size: var(--bs-nav-link-font-size);
        font-weight: var(--bs-nav-link-font-weight);
        color: var(--bs-nav-link-color);
        text-decoration: none;
        background: 0 0;
        border: 0;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out;
    }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header" style="background-color:#48484a;">

         <br>
         <br>     <br>
         <br>     <br>
         <br>
        </div >
        <div style=" margin-top: -60px;        ">  <img class="img-fluid mx-auto d-block" src="https://alsoliman.com.sa/theme/images/logo.svg" alt="logo" width="150px" hieght="40px"> </div>
        <div class="card-body">
            <div class="container mt-3">

            <h2 class="text-center" style="font-size: -webkit-xxx-large;">سجل اهتمامك</h2>
              <p class="text-center" style="color: gray;">يسعدنا تسجيل اهتمامك بمشاريع شركة السليمان العقارية</p>
            <form id="login" onsubmit="process(event)">
            @if ($form->name)
            <div class="mb-3">
                <label for="pwd">الاسم الثنائي</label>
                <input type="text" class="form-control" id="name" placeholder="سجل اسمك" name="pswd" required>
                <span id="nameError" class="error"></span>

            </div>
            @endif
            @if ($form->phone)
            <div class="mb-3 mt-3">
                <label for="phone">رقم الجوال</label><br>
                <input id="phone" type="tel" name="phone"  class="form-control"  required>
                <span id="phoneError" class="error"></span>
            </div>
            @endif
            @if ($form->email)
            <div class="mb-3 mt-3">
                <label for="email">البريد الالكتروني</label>
                <input type="email" class="form-control" id="email" placeholder="البريد الالكتروني" name="email" required>
                <span id="emailError" class="error"></span>
            </div>
            @endif

            <input type="hidden" name="form_id" value="{{$form->id}}" id="form_id">
             <div class="col-12 text-center">
                    <button type="button"
                    style="background-color: #0186be; color: white; padding-left: 5%;padding-right: 5%;"
                    id="submitBtn"
                    {{-- data-bs-toggle="modal"
                    data-bs-target="#myModal" --}}
                    class="btn">سجل اهتمامك</button>
              </div>
              <br>
              <br><br>
              <div class="col-12 text-center">
                <p dir="ltr"><span>&#169;</span>2024 ASOLIMAN REAL ESTATE Co.
              </p>
            </div>


            </div>

            </form>
          </div>
        </div>

      </div>

      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">

            <div class="col-12 text-center">
                     <i class='fas fa-check-circle' style='font-size:48px;color:#0186be'></i>
                     <h2>شكرا لك تم تسجيل اهتمامك</h2>
                     <span>سيتم التواصل معك من قبل ممثلي المبيعات باسرع وقت ممكن</span>
                     <br>
                    <br><br>
                      <span>للاستفسار اتصل على</span>
                      <h3>920003511</h3>

                      <br>
                    <br><br>

                  <h4><a class="nav-link" style="    border-bottom: 2px solid #0186be; display: ;" href="{{route('home')}}">الرئيسية</a></h4>

             </div>



          </div>
        </div>
      </div>
      </div>
      <script>
        document.getElementById('submitBtn').addEventListener('click', function () {

            if(!validateForm()) return;
            document.getElementById('submitBtn').disabled = true;

            var data = {
                name: document.getElementById('name').value,
                phone: document.getElementById('phone').value,
                email: document.getElementById('email').value,
                form_id: document.getElementById('form_id').value

            };
            data._token = '{{ csrf_token() }}';

            fetch("{{route('save-form-data')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                // Handle the response data
                console.log(data);
                var modal = document.getElementById('myModal');
                name: document.getElementById('name').value = "";
                phone: document.getElementById('phone').value = "";
                email: document.getElementById('email').value = "";
                modal.style.display = 'block';
                document.getElementById('submitBtn').disabled = false;

            return;
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
            });
        });


        function validateForm() {
            // Reset error messages
            document.getElementById('nameError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('phoneError').textContent = '';

            // Get form values
            var name = document.getElementById('name').value.trim();
            var email = document.getElementById('email').value.trim();
            var phone = document.getElementById('phone').value.trim();

            // Perform validation
            var isValid = true;

            @if ($form->name)
            if (name === '') {
                document.getElementById('nameError').textContent = 'Name is required';
                isValid = false;
            }
            @endif
            @if ($form->phone)
            if (phone === '') {
                document.getElementById('phoneError').textContent = 'phone is required';
                isValid = false;
            }
            @endif
            // Add more validation rules as needed
            // ...
            @if ($form->email)
            if (email != '') {
                if (!isValidEmail(email)) {
                document.getElementById('emailError').textContent = 'Invalid email format';
                isValid = false;
                 }

            }
             // document.getElementById('emailError').textContent = 'Email is required';
                // isValid = false;
            @endif


            // Submit the form if validation passes

            console.log(isValid);
            return isValid;
        }

        function isValidEmail(email) {
            // Add your email validation logic here
            // This is a simple example, you might want to use a regular expression
            return email.includes('@');
        }
    </script>

      {{-- <script>
        const phoneInputField = document.querySelector("#phone");
        initialCountry: "sa"

        const phoneInput = window.intlTelInput(phoneInputField, {
          initialCountry: "SA",
          utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
      </script> --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.min.js"></script>
      <script>
            var input = document.querySelector("#phone");

// Initialize intlTelInput
var iti = window.intlTelInput(input, {
    autoPlaceholder: "polite",
    initialCountry: "sa",
    preferredCountries: ['sa', 'ue', 'qa'],
    separateDialCode: true,
    nationalMode: false,
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
});

// Listen to the telephone input for changes and update the input value
input.addEventListener('countrychange', function() {
    var fullNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164);
    input.value = fullNumber; // Update the input value with the full number
});

input.addEventListener('change', function() {
    var fullNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164);
    input.value = fullNumber;
});

input.addEventListener('keyup', function() {
    var fullNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164);
    input.value = fullNumber;
});

        </script>
</body>
</html>
