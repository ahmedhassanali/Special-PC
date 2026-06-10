<!doctype html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    style="direction: @if (app()->getLocale() === 'ar') rtl @else ltr @endif;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link href="{{ asset('assets/img/special-pc-logo-dark.png') }}" rel="icon">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="171">
    <meta property="og:image" content="{{ asset('assets/img/special-pc-logo-white.png') }}">

    <!-- Google Web Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="{{ asset('assets/lib/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- Template Stylesheet -->
    @if (app()->getLocale() === 'ar')
        <link rel="stylesheet" href="{{ asset('assets/css/rtl-style.css')}}" media="all">
    @else
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @endif
    <title>{{ config('app.name', 'Laravel') }} | Admin Portal</title>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('new_order_channel');
        channel.bind('App\\Events\\NewOrderEvent', function(data) {
            console.log(data['message']);


            $("#ordersTable").load(" #ordersTable > *");
            $("#notifications-dropdown").load(" #notifications-dropdown > *");

            Swal.fire({
                title: 'New Order Received!',
                text: data['message'],
                icon: 'success',
                width: '25rem',
                padding: '1rem',
                position: 'center-end',
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                timerProgressBar: true
            });

        });
    </script>

</head>

<body>
    <main>

        <div class="position-relative d-flex p-0 mx-1">
            <!-- Spinner Start -->
            <div id="spinner"
                class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <!-- Spinner End -->


            <!-- Sidebar Start -->
            @include('admin.layouts.sidenav')
            <!-- Sidebar End -->


            <!-- Content Start -->
            <div class="content">
                <!-- Navbar Start -->
                @include('admin.layouts.navbar')
                <!-- Navbar End -->
                @yield('content')
            </div>
        </div>
    </main>
    @include('admin.layouts.footer')



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/lib/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/lib/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/js/admin-datatbles.js') }}"></script>


    <script src="https://unpkg.com/gsap@3/dist/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.5.1/snap.svg-min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/SplitText.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/ScrambleTextPlugin.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/PhysicsPropsPlugin.min.js"></script>
    <script src="https://unpkg.com/gsap@3/dist/Physics2DPlugin.min.js"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>



    <script>
      var chart_h = 40;
      var chart_w = 80;
      var stepX = 77 / 14;

      var chart_1_y = [15, 25, 40, 30, 45, 40, 35, 55, 37, 50, 60, 45, 70, 78];
      var chart_2_y = [80, 65, 65, 40, 55, 34, 54, 50, 60, 64, 55, 27, 24, 30];

      function point(x, y) {
        x: 0;
        y: 0;
      }
      /* DRAW GRID */
      function drawGrid(graph) {
        var graph = Snap(graph);
        var g = graph.g();
        g.attr("id", "grid");
        for (i = 0; i <= stepX + 2; i++) {
          var horizontalLine = graph.path(
            "M" + 0 + "," + stepX * i + " " + "L" + 77 + "," + stepX * i
          );
          horizontalLine.attr("class", "horizontal");
          g.add(horizontalLine);
        }
        for (i = 0; i <= 14; i++) {
          var horizontalLine = graph.path(
            "M" + stepX * i + "," + 38.7 + " " + "L" + stepX * i + "," + 0
          );
          horizontalLine.attr("class", "vertical");
          g.add(horizontalLine);
        }
      }
      drawGrid("#chart-2");
      drawGrid("#chart-1");

      function drawLineGraph(graph, points, container, id) {
        var graph = Snap(graph);

        var myPoints = [];
        var shadowPoints = [];

        function parseData(points) {
          for (i = 0; i < points.length; i++) {
            var p = new point();
            var pv = (points[i] / 100) * 40;
            p.x = (83.7 / points.length) * i + 1;
            p.y = 40 - pv;
            if (p.x > 78) {
              p.x = 78;
            }
            myPoints.push(p);
          }
        }

        var segments = [];

        function createSegments(p_array) {
          for (i = 0; i < p_array.length; i++) {
            var seg = "L" + p_array[i].x + "," + p_array[i].y;
            if (i === 0) {
              seg = "M" + p_array[i].x + "," + p_array[i].y;
            }
            segments.push(seg);
          }
        }

        function joinLine(segments_array, id) {
          var line = segments_array.join(" ");
          var line = graph.path(line);
          line.attr("id", "graph-" + id);
          var lineLength = line.getTotalLength();

          line.attr({
            "stroke-dasharray": lineLength,
            "stroke-dashoffset": lineLength,
          });
        }

        function calculatePercentage(points, graph) {
          var initValue = points[0];
          var endValue = points[points.length - 1];
          var sum = endValue - initValue;
          var prefix;
          var percentageGain;
          var stepCount = 1300 / sum;

          function findPrefix() {
            if (sum > 0) {
              prefix = "+";
            } else {
              prefix = "";
            }
          }

          var percentagePrefix = "";

          function percentageChange() {
            percentageGain = (initValue / endValue) * 100;

            if (percentageGain > 100) {
              console.log("over100");
              percentageGain = Math.round(percentageGain * 100 * 10) / 100;
            } else if (percentageGain < 100) {
              console.log("under100");
              percentageGain = Math.round(percentageGain * 10) / 10;
            }
            if (initValue > endValue) {
              percentageGain = (endValue / initValue) * 100 - 100;
              percentageGain = percentageGain.toFixed(2);

              percentagePrefix = "";
              $(graph).find(".percentage-value").addClass("negative");
            } else {
              percentagePrefix = "+";
            }
            if (endValue > initValue) {
              percentageGain = (endValue / initValue) * 100;
              percentageGain = Math.round(percentageGain);
            }
          }
          percentageChange();
          findPrefix();

          var percentage = $(graph).find(".percentage-value");
          var totalGain = $(graph).find(".total-gain");
          var hVal = $(graph).find(".h-value");

          function count(graph, sum) {
            var totalGain = $(graph).find(".total-gain");
            var i = 0;
            var time = 1300;
            var intervalTime = Math.abs(time / sum);
            var timerID = 0;
            if (sum > 0) {
              var timerID = setInterval(function () {
                i++;
                totalGain.text(percentagePrefix + i);
                if (i === sum) clearInterval(timerID);
              }, intervalTime);
            } else if (sum < 0) {
              var timerID = setInterval(function () {
                i--;
                totalGain.text(percentagePrefix + i);
                if (i === sum) clearInterval(timerID);
              }, intervalTime);
            }
          }
          count(graph, sum);

          percentage.text(percentagePrefix + percentageGain + "%");
          totalGain.text("0%");
          setTimeout(function () {
            percentage.addClass("visible");
            hVal.addClass("visible");
          }, 1300);
        }

        function showValues() {
          var val1 = $(graph).find(".h-value");
          var val2 = $(graph).find(".percentage-value");
          val1.addClass("visible");
          val2.addClass("visible");
        }

        function drawPolygon(segments, id) {
          var lastel = segments[segments.length - 1];
          var polySeg = segments.slice();
          polySeg.push([78, 38.4], [1, 38.4]);
          var polyLine = polySeg.join(" ").toString();
          var replacedString = polyLine.replace(/L/g, "").replace(/M/g, "");

          var poly = graph.polygon(replacedString);
          var clip = graph.rect(-80, 0, 80, 40);
          poly.attr({
            id: "poly-" + id,
            /*'clipPath':'url(#clip)'*/
            clipPath: clip,
          });
          clip.animate(
            {
              transform: "t80,0",
            },
            1300,
            mina.linear
          );
        }

        parseData(points);

        createSegments(myPoints);
        calculatePercentage(points, container);
        joinLine(segments, id);

        drawPolygon(segments, id);
      }

      function drawCircle(container, id, progress, parent) {
        var paper = Snap(container);
        var prog = paper.path("M5,50 A45,45,0 1 1 95,50 A45,45,0 1 1 5,50");
        var lineL = prog.getTotalLength();
        var oneUnit = lineL / 100;
        var toOffset = lineL - oneUnit * progress;
        var myID = "circle-graph-" + id;
        prog.attr({
          "stroke-dashoffset": lineL,
          "stroke-dasharray": lineL,
          id: myID,
        });

        var animTime = 1300; /*progress / 100*/

        prog.animate(
          {
            "stroke-dashoffset": toOffset,
          },
          animTime,
          mina.easein
        );

        function countCircle(animtime, parent, progress) {
          var textContainer = $(parent).find(".circle-percentage");
          var i = 0;
          var time = 1300;
          var intervalTime = Math.abs(time / progress);
          var timerID = setInterval(function () {
            i++;
            textContainer.text(i + "%");
            if (i === progress) clearInterval(timerID);
          }, intervalTime);
        }
        countCircle(animTime, parent, progress);
      }

      $(window).on("load", function () {
        drawCircle("#chart-3", 1, 77, "#circle-1");
        drawCircle("#chart-4", 2, 53, "#circle-2");
        drawLineGraph("#chart-1", chart_1_y, "#graph-1-container", 1);
        drawLineGraph("#chart-2", chart_2_y, "#graph-2-container", 2);
      });
    </script>


    @if (session('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'نجاح',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'خطأ',
                icon: 'error',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @yield('delete')
    @yield('scripts')


    <script>
        $(document).ready(function() {
            $('#category_id').change(function() {
                var selectedCategoryId = $(this).val();
                console.log(selectedCategoryId);
                if (selectedCategoryId) {
                    $.ajax({
                        url: '/admin/subCategory/getAll/' + selectedCategoryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var subcategorySelect = $('#subCategory_id');
                            subcategorySelect.empty();
                            $.each(data, function(index, subcategory) {
                                subcategorySelect.append($('<option>', {
                                    value: subcategory.id,
                                    text: subcategory.en_title
                                }));
                            });
                        }
                    });
                }
            });
        });
    </script>


    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>
    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    @include('admin.layouts.message')

    <!-- Initialize Quill editor -->
    <script>
        if ($('#editor').length > 0) {
            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{
                            'color': []
                        }],
                        ['bold', 'italic', 'underline'],
                    ]
                }
            });

            var form = document.getElementById('setting_form');

            var arHiddenInput = document.getElementById('arHiddenInput');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                var content = quill.root.innerHTML;
                arHiddenInput.value = content;

                this.submit();
            });
        }

        if ($('#editor1').length > 0) {
            var quill1 = new Quill('#editor1', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{
                            'color': []
                        }],
                        ['bold', 'italic', 'underline'],
                    ]
                }
            });

            var form = document.getElementById('setting_form');
            var enHiddenInput = document.getElementById('enHiddenInput');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                var content = quill1.root.innerHTML;
                enHiddenInput.value = content;

                this.submit();
            });
        }
    </script>

    <script>
        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyDYPsYCso9o5f3dBdDZPErxNM1KvmJlZjg",
            authDomain: "live-hemdania.firebaseapp.com",
            projectId: "live-hemdania",
            storageBucket: "live-hemdania.appspot.com",
            messagingSenderId: "763430146805",
            appId: "1:763430146805:web:8692efced8c3211c95abbc",
            measurementId: "G-7LWFJ79X6K"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function initFirebaseMessagingRegistration() {
            messaging.requestPermission().then(function() {
                return messaging.getToken()
            }).then(function(token) {
                $.ajax({
                    type: 'PATCH',
                    url: '{{ route('fcmToken') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        token: token
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
        }
        initFirebaseMessagingRegistration();
        messaging.onMessage(function(data) {
            console.log(data);
            if (data.data) {
                if (data.data.type == 'message') {
                    $('#CounterMsgs').html(parseInt($('#CounterMsgs').html()) + 1);
                }
            } else {
                $('#CounterNots').html(parseInt($('#CounterNots').html()) + 1);
            }
            Swal.fire({
                title: data.notification.title,
                text: data.notification.body,
                icon: 'info',
                confirmButtonText: {{ __('Ok') }}
            });
        });
        $(document).ready(function() {
            $(document).on('click', '#showNotifications', function() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.notification.unread') }}',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('.nots-list').html(data);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', ".notificationsIcon", function() {
                $.ajax({
                    url: {{ Illuminate\Support\Js::from(route('admin.notification.markAsRead')) }},
                    method: 'get',
                    success: function(data) {
                        $("#notificationsModel").load(" #notificationsModel > *");
                        $("#notificationsIconCounter").load(" #notificationsIconCounter > *");
                    },
                    error: function() {
                        alert('please try again ....');
                    },
                });
            });
        });

        $(document).ready(function() {
            $(document).on('click', ".clearNotifications", function() {
                $.ajax({
                    url: {{ Illuminate\Support\Js::from(route('admin.notification.clear')) }},
                    method: 'get',
                    success: function(data) {
                        $("#notificationsIconCounter").load(" #notificationnsIconCounter > *");
                        $("#notificationsModel").load(" #notificationsModel > *");
                    },
                    error: function() {
                        alert('please try again ....');
                    },
                });
            });
        });
    </script>


<script>
    $(document).ready(function() {
        $('body').on('dblclick', 'label, span, h1, h2, h3, h4, h5, h6 , a, p,th,td,i', function() {
            var textContent = $(this).text();
            if (textContent.match(/\b\w+\.\w+\b/)) {
                // Prompt the user to confirm translation
                Swal.fire({
                    title: 'Translation',
                    text: 'Do you want to translate this text?' + textContent,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Translate',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        translate(textContent);
                    }
                });
            }
        });

        function capitalizeFirstLetter(word) {
            return word.charAt(0).toUpperCase() + word.slice(1);
        }

        function translate(text) {
            var parts = text.split('.');
            var langFile = parts[0] + '.php';

            var key = parts[1];

            var englishValue = parts[1].split('_').map(function(word) {
                return word.charAt(0).toUpperCase() + word.slice(1);
            }).join(' ');


            addTranslation(langFile, key, englishValue);
        }

        // Function to add translation
        function addTranslation(langFile, key, englishValue) {
            console.log(langFile, englishValue, key);
            $.ajax({
                url: "{{ route('admin.translation.addTranslation') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    langFile: langFile,
                    key: key,
                    englishValue: englishValue,
                    arabicValue: englishValue
                },
                success: function(response) {
                    window.location.href = "{{ route('admin.translation.showEditLang') }}";
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    });
</script>

</body>

</html>
