@extends('admin.layouts.admin') @section('content')
<!-- Content Start -->

<!-- Sale & Revenue Start -->
<div class="container-fluid pt-4 px-4 home">
  <div class="row g-4">

    <!-- احصائيات -->
    <div class="col-lg-4 col-6 col-xs-12">
      <div class="card overflow-hidden stat">
        <div class="card-body d-flex">
          <div class="card-info">
            <h5
              class="text-muted fs-13 text-uppercase"
              title="Number of Orders"
            >
              جميع الطلبات
              <!-- {{ __('dashboard.month_orders') }} -->
            </h5>
            <div class="d-flex align-items-center gap-2 my-2 py-1">
              <div class="user-img fs-42 flex-shrink-0">
                <span class="avatar-title text-bg-primary rounded-circle fs-22">
                  <i class="fa fa-chart-bar text-white"></i>
                </span>
              </div>
              <h3 class="mb-0 fw-bold">
                687.3k
                <!-- {{ $numOfOrdersThisMonth }} -->
              </h3>
              <i class="fa fa-duotone fa-solid fa-truck-fast"></i>
            </div>
            <p class="mb-0 text-muted">
              <span class="text-danger me-2"
                ><i class="ti ti-caret-down-filled"></i> 9.19%</span
              >
              <span class="text-nowrap">من الشهر الماضي</span>
            </p>
          </div>
          <div class="charts-container cf">
            <div class="chart" id="graph-1-container">
              <div class="chart-svg">
                <svg class="chart-line" id="chart-1" viewBox="0 0 80 40">
                  <defs>
                    <clipPath id="clip" x="0" y="0" width="80" height="40">
                      <rect
                        id="clip-rect"
                        x="-80"
                        y="0"
                        width="77"
                        height="38.7"
                      />
                    </clipPath>

                    <linearGradient id="gradient-1">
                      <stop offset="0" stop-color="#00d5bd" />
                      <stop offset="100" stop-color="#24c1ed" />
                    </linearGradient>

                    <linearGradient id="gradient-2">
                      <stop offset="0" stop-color="#954ce9" />
                      <stop offset="0.3" stop-color="#954ce9" />
                      <stop offset="0.6" stop-color="#24c1ed" />
                      <stop offset="1" stop-color="#24c1ed" />
                    </linearGradient>

                    <linearGradient
                      id="gradient-3"
                      x1="0%"
                      y1="0%"
                      x2="0%"
                      y2="100%"
                    >
                      <stop
                        offset="0"
                        stop-color="rgba(0, 213, 189, 1)"
                        stop-opacity="0.07"
                      />
                      <stop
                        offset="0.5"
                        stop-color="rgba(0, 213, 189, 1)"
                        stop-opacity="0.13"
                      />
                      <stop
                        offset="1"
                        stop-color="rgba(0, 213, 189, 1)"
                        stop-opacity="0"
                      />
                    </linearGradient>

                    <linearGradient
                      id="gradient-4"
                      x1="0%"
                      y1="0%"
                      x2="0%"
                      y2="100%"
                    >
                      <stop
                        offset="0"
                        stop-color="rgba(149, 76, 233, 1)"
                        stop-opacity="0.07"
                      />
                      <stop
                        offset="0.5"
                        stop-color="rgba(149, 76, 233, 1)"
                        stop-opacity="0.13"
                      />
                      <stop
                        offset="1"
                        stop-color="rgba(149, 76, 233, 1)"
                        stop-opacity="0"
                      />
                    </linearGradient>
                  </defs>
                </svg>
                <div class="chart-values">
                    <!-- <p class="total-gain"></p> -->
                    <h3 class="valueX">time</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- احصائيات -->
    <div class="col-lg-4 col-6 col-xs-12">
      <div class="card overflow-hidden stat">
        <div class="card-body d-flex">
          <div class="card-info">
            <h5
              class="text-muted fs-13 text-uppercase"
              title="Number of Orders"
            >
              {{ __('dashboard.today_orders') }}
            </h5>
            <div class="d-flex align-items-center gap-2 my-2 py-1">
              <div class="user-img fs-42 flex-shrink-0">
                <span class="avatar-title text-bg-primary rounded-circle fs-22">
                  <i class="fa fa-chart-line text-white"></i>
                </span>
              </div>
              <h3 class="mb-0 fw-bold">
                87.3
                <!-- {{ $numOfOrdersToday }} -->
              </h3>
              <i class="fa fa-duotone fa-solid fa-truck-fast"></i>
            </div>
            <p class="mb-0 text-muted">
              <span class="text-danger me-2"
                ><i class="ti ti-caret-down-filled"></i> 9.19%</span
              >
              <span class="text-nowrap">من أمس </span>
            </p>
          </div>

          <div class="charts-container cf">
            <div class="chart" id="graph-2-container">
              <div class="chart-svg">
                <svg class="chart-line" id="chart-2" viewBox="0 0 80 40"></svg>
                <div class="chart-values">
                    <!-- <p class="total-gain"></p> -->
                    <h3 class="valueX">time</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- احصائيات -->
    <div class="col-lg-4 col-6 col-xs-12">
      <div class="card overflow-hidden stat">
        <div class="card-body d-flex">
          <div class="card-info">
            <h5
              class="text-muted fs-13 text-uppercase"
              title="Number of Orders"
            >
              {{ __('dashboard.today_sales') }}
            </h5>
            <div class="d-flex align-items-center gap-2 my-2 py-1">
              <div class="user-img fs-42 flex-shrink-0">
                <span class="avatar-title text-bg-primary rounded-circle fs-22">
                  <i class="fa fa-chart-area text-white"></i>
                </span>
              </div>
              <h3 class="mb-0 fw-bold">
                87.3
                <!-- {{ $totalOrderAmountToday }} -->
              </h3>
              <i class="fa fa-duotone fa-solid fa-truck-fast"></i>
            </div>
            <p class="mb-0 text-muted">
              <span class="text-danger me-2">
                <i class="ti ti-caret-down-filled"></i> 9.19%
              </span>
              <span class="text-nowrap">من أمس </span>
            </p>
          </div>
          <div class="charts-container cf">
            <div class="chart circle" id="circle-1">
              <div class="chart-svg align-center">
                <h2 class="circle-percentage"></h2>
                <svg
                  class="chart-circle"
                  id="chart-3"
                  width="50%"
                  viewBox="0 0 100 100"
                >
                  <path
                    class="underlay"
                    d="M5,50 A45,45,0 1 1 95,50 A45,45,0 1 1 5,50"
                  />
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- احصائيات -->
    <div class="col-lg-4 col-6 col-xs-12">
      <div class="card overflow-hidden stat">
        <div class="card-body d-flex flex-column">
            <h5
              class="text-muted fs-13 text-uppercase"
              title="Number of Orders">
              {{ __('dashboard.month_sales') }}
            </h5>
          <div class="d-flex">
              <div class="card-info">
                <div class="d-flex align-items-center gap-2 my-2 py-1">
                  <div class="user-img fs-42 flex-shrink-0">
                    <span class="avatar-title text-bg-primary rounded-circle fs-22">
                      <i class="fa fa-chart-pie text-white"></i>
                    </span>
                  </div>
                  <h3 class="mb-0 fw-bold">
                     87.3
                              <!-- {{ $totalOrderAmountToday }} -->
                  </h3>
                  <i class="fa fa-duotone fa-solid fa-truck-fast"></i>
                </div>
                <p class="mb-0 text-muted">
                    <span class="text-danger me-2">
                      <i class="ti ti-caret-down-filled"></i> 9.19%
                    </span>
                    <span class="text-nowrap">من أمس </span>
                </p>
              </div>
              <div class="charts-container cf">
                  <div class="chart circle" id="circle-2">
                      <div class="chart-svg align-center">
                        <h2 class="circle-percentage"></h2>
                          <svg
                          class="chart-circle"
                          id="chart-4"
                          width="50%"
                          viewBox="0 0 100 100"
                          >
                          <path
                          class="underlay"
                          d="M5,50 A45,45,0 1 1 95,50 A45,45,0 1 1 5,50"
                          />
                          </svg>
                      </div>
                  </div>
              </div>
          </div>  
        </div>
      </div>
    </div>

    <!-- جدول اكثر المنتجات مبيعا -->
    <div class="col-lg-8 col-6 col-xs-12"> 
      <div class="card overflow-hidden">
        <div class="p-3">
          <h4 class="h4 mt-2 mb-sm-0"> اكثر المنتجات مبيعا</h4>
        </div>
        
        <div class="card-body">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="border-0">المنتج</th>
                        <th class="border-0">السعر</th>
                        <th class="border-0">عدد مرات البيع</th>
                        <th class="border-0">المخزون</th>
                    </tr><!--end tr-->
                </thead>

                <tbody>
                      <tr>                                                        
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="{{ asset('assets/img/product.jpg') }}" height="40" class="me-3 align-self-center rounded" alt="...">
                                  <div class="flex-grow-1 text-truncate"> 
                                      <h6 class="m-0">headphones</h6>
                                      <a href="#" class="fs-12 text-primary">ID: A3652</a>                                                                                           
                                  </div>
                                  <!--end media body-->
                              </div>
                          </td>
                            <td>ريال 50</td>                                   
                            <td>450 </td>
                            <td>
                              <span class="badge primary-light px-2">
                                Stock
                              </span>
                            </td>
                            <!-- <td>                                                       
                                <a href="#"class="link">
                                   <i class="fa fa-edit"></i>
                                </a>
                                <a href="#"class="link text-red">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td> -->
                      </tr><!--end tr-->   
                                                 
                      <tr>                                                        
                          <td>
                              <div class="d-flex align-items-center">
                                  <img src="{{ asset('assets/img/product.jpg') }}" height="40" class="me-3 align-self-center rounded" alt="...">
                                      <div class="flex-grow-1 text-truncate"> 
                                          <h6 class="m-0">headphones</h6>
                                          <a href="#" class="fs-12 text-primary">ID: A3652</a>                                                                                           
                                      </div>
                                      <!--end media body-->
                                </div>
                          </td>
                          <td>ريال 50</td>                                   
                          <td>450 </td>
                          <td>
                              <span class="badge red px-2">
                                Out of Stock
                              </span>
                          </td>
                      </tr><!--end tr-->   
                </tbody>
            </table> <!--end table-->                                               
        </div>
        </div>
      </div>
    </div>

     <!-- جدول العملاء الاكثر تكرار الشراء -->
    <div class="col-lg-4 col-6 col-xs-12">
      <div class="card overflow-hidden">
          <div class="p-3">
              <h4 class="h4 mt-2 mb-sm-0">   العملاء الأكثر شراءا     </h4>    
          </div>

          <div class="card-body">
              <div class="table-responsive">
                  <table class="table mb-0">
                      <tbody>
                          <tr class="">                                                        
                              <td class="px-0">
                                  <div class="d-flex align-items-center">
                                      <img src="{{ asset('assets/img/user.jpg') }}" height="36" class="me-2 align-self-center rounded" alt="...">
                                          <div class="flex-grow-1 text-truncate"> 
                                              <h6 class="m-0 text-truncate">عبد الكريم السريع</h6>
                                              <a href="#" class="font-12 text-muted text-decoration-underline">#3652</a>                                                                                           
                                          </div><!--end media body-->
                                  </div><!--end media-->
                              </td>

                              <td class="px-0 text-end">
                                <span class="text-primary ps-2 align-self-center text-end">
                                  3325.00
                                </span>
                              </td>  

                          </tr><!--end tr-->  
                          <tr class="">                                                        
                                <td class="px-0">
                                    <div class="d-flex align-items-center">
                                          <img src="{{ asset('assets/img/user.jpg') }}" height="36" class="me-2 align-self-center rounded" alt="...">
                                            <div class="flex-grow-1 text-truncate"> 
                                              <h6 class="m-0 text-truncate">عبد الكريم السريع</h6>
                                              <a href="#" class="font-12 text-muted text-decoration-underline">#4789</a>                                                                                           
                                            </div><!--end media body-->
                                    </div><!--end media-->
                                </td>
                                <td class="px-0 text-end">
                                  <span class="text-primary ps-2 align-self-center text-end">
                                    2548.00
                                  </span>
                                </td>  
                          </tr><!--end tr-->       
                          
                             <tr class="">                                                        
                                <td class="px-0">
                                    <div class="d-flex align-items-center">
                                          <img src="{{ asset('assets/img/testimonial-2.jpg') }}" height="36" class="me-2 align-self-center rounded" alt="...">
                                            <div class="flex-grow-1 text-truncate"> 
                                              <h6 class="m-0 text-truncate">عبد الكريم السريع</h6>
                                              <a href="#" class="font-12 text-muted text-decoration-underline">#4789</a>                                                                                           
                                            </div><!--end media body-->
                                    </div><!--end media-->
                                </td>
                                <td class="px-0 text-end">
                                  <span class="text-primary ps-2 align-self-center text-end">
                                    2548.00
                                  </span>
                                </td>  
                          </tr><!--end tr-->     
                      </tbody>
                  </table> <!--end table-->                                               
              </div><!--end /div-->                           
          </div><!--end card-body--> 
      </div>

    </div>

    <!-- حالات احدث الطلبات -->
    <div class="col-lg-8 col-6 col-xs-12">
      <div class="card overflow-hidden">
          <div class="p-3">
              <h4 class="h4 mt-2 mb-sm-0">احدث الطلبات</h4>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                  <table class="table table-custom table-centered table-sm table-nowrap table-hover mb-0">
                      <tbody>
                        <tr>
                            <td>
                                <span class="text-muted fs-12">العميل</span> 
                            </td>

                            <td>
                                <span class="text-muted fs-12">تاريخ الطلب</span>
                            </td>

                            <td>
                                <span class="text-muted fs-12">الاجمالي</span> <br>
                            </td>

                            <td>
                                <span class="text-muted fs-12">الحاله</span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                      <div class="avatar-md flex-shrink-0 me-2">
                                        <span class="avatar-title bg-primary-subtle rounded-circle">
                                            <img src="{{ asset('assets/img/bubble-gum-box.gif') }}" alt="" height="22">
                                        </span>
                                      </div>
                                      <div>
                                        <h5 class="fs-14 mt-1">عبد الكريم السريع</h5>
                                      </div>
                                </div>
                            </td>

                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">31/07/2025</h5>
                            </td>

                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">1009</h5>
                            </td>

                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">
                                  <i class="bi bi-circle-fill fs-12 text-teal"></i>
                                  تم التوصيل
                                </h5>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                      <div class="avatar-md flex-shrink-0 me-2">
                                        <span class="avatar-title bg-primary-subtle rounded-circle">
                                            <img src="{{ asset('assets/img/bubble-gum-box.gif') }}" alt="" height="22">
                                        </span>
                                      </div>
                                      <div>
                                        <h5 class="fs-14 mt-1">آية هاني</h5>
                                      </div>
                                </div>
                            </td>
                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">30/07/2025</h5>
                            </td>
                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">700</h5>
                            </td>
                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">
                                  <i class="bi bi-circle-fill fs-12 text-yellow"></i>
                                   خرج للتوصيل
                                </h5>
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                      <div class="avatar-md flex-shrink-0 me-2">
                                        <span class="avatar-title bg-primary-subtle rounded-circle">
                                            <img src="{{ asset('assets/img/bubble-gum-box.gif') }}" alt="" height="22">
                                        </span>
                                      </div>
                                      <div>
                                        <h5 class="fs-14 mt-1">أحمد حسن</h5>
                                      </div>
                                </div>
                            </td>
                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">29/07/2025</h5>
                            </td>
                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">1700</h5>
                            </td>
                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">
                                  <i class="bi bi-circle-fill fs-12 text-red"></i>
                                   تم الإلغاء
                                </h5>
                            </td>
                        </tr>

                           <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                      <div class="avatar-md flex-shrink-0 me-2">
                                        <span class="avatar-title bg-primary-subtle rounded-circle">
                                            <img src="{{ asset('assets/img/bubble-gum-box.gif') }}" alt="" height="22">
                                        </span>
                                      </div>
                                      <div>
                                        <h5 class="fs-14 mt-1">عبد الكريم السريع</h5>
                                      </div>
                                </div>
                            </td>

                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">31/07/2025</h5>
                            </td>

                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">1009</h5>
                            </td>

                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">
                                  <i class="bi bi-circle-fill fs-12 text-teal"></i>
                                  تم التوصيل
                                </h5>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                      <div class="avatar-md flex-shrink-0 me-2">
                                        <span class="avatar-title bg-primary-subtle rounded-circle">
                                            <img src="{{ asset('assets/img/bubble-gum-box.gif') }}" alt="" height="22">
                                        </span>
                                      </div>
                                      <div>
                                        <h5 class="fs-14 mt-1">آية هاني</h5>
                                      </div>
                                </div>
                            </td>
                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">30/07/2025</h5>
                            </td>
                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">700</h5>
                            </td>
                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">
                                  <i class="bi bi-circle-fill fs-12 text-yellow"></i>
                                   خرج للتوصيل
                                </h5>
                            </td>
                        </tr>

                         <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                      <div class="avatar-md flex-shrink-0 me-2">
                                        <span class="avatar-title bg-primary-subtle rounded-circle">
                                            <img src="{{ asset('assets/img/bubble-gum-box.gif') }}" alt="" height="22">
                                        </span>
                                      </div>
                                      <div>
                                        <h5 class="fs-14 mt-1">أحمد حسن</h5>
                                      </div>
                                </div>
                            </td>
                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">29/07/2025</h5>
                            </td>
                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">1700</h5>
                            </td>
                            <td>
                                <h5 class="fs-14 mt-1 fw-normal">
                                  <i class="bi bi-circle-fill fs-12 text-red"></i>
                                   تم الإلغاء
                                </h5>
                            </td>
                        </tr>

                      </tbody>
                  </table>
              </div> <!-- end table-responsive-->
          </div> <!-- end card-body-->

        </div>
    </div>

  </div>
</div>

<!-- الاحصائيات القديمه -->
<div class="container-fluid pt-4 px-4">
  <!-- <div class="row g-4">
    <div class="col-sm-12 col-xl-6">
      <div class="bg-white text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h6 class="mb-0">{{ __('dashboard.worldwide_sales') }}</h6>
          <a href="{{ route('admin.report.index') }}">
            {{ __('dashboard.show_all') }}</a
          >
        </div>
        <canvas id="worldwide-sales"></canvas>
      </div>
    </div>
    <div class="col-sm-12 col-xl-6">
      <div class="bg-white text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h6 class="mb-0">{{ __('dashboard.salse_and_revenue') }}</h6>
          <a href="{{ route('admin.report.index') }}">
            {{ __('dashboard.show_all') }}</a
          >
        </div>
        <canvas id="salse-revenue"></canvas>
      </div>
    </div>
  </div> -->
</div>


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
  <i class="bi bi-arrow-up"></i>
</a>
@endsection
