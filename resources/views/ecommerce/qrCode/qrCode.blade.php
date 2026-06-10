<html lang="ar" dir="rtl">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/bootstrap-5.2.3-dist/css/bootstrap.rtl.min.css')}}">

	<style>
		.invoice-box {
			height: 1400px;
			display: flex;
			flex-direction: column;
		}

		p {
			margin-block-start: 0;
			margin-block-end: 0;
		}

		table thead th,
		table thead td {
			padding: 0;
			vertical-align: middle;
		}

		thead,
		tbody,
		tfoot,
		tr,
		td,
		th {
			padding: 4px 10px;
			font-size: 20px;
			border: 0.5px solid;
			text-align: center;
			font-size: 16px;
		}

		.wide p {
			max-width: 380px;
		}

		.gap-10 {
			gap: 10px;
		}
		.code{
			width:100px;
		}
		@media print {
			* {
				-webkit-print-color-adjust: exact;
				print-color-adjust: exact;
			}

			#noprint {
				visibility: hidden;
			}

			*,
			:after,
			:before {
				box-shadow: none !important;
				text-shadow: none !important
			}

			a,
			a:visited {
				text-decoration: underline
			}

			a[href]:after {
				content: " (" attr(href) ")"
			}

			abbr[title]:after {
				content: " (" attr(title) ")"
			}

			a[href^="#"]:after,
			a[href^="javascript:"]:after {
				content: ""
			}

			a[href]:after {
				content: "" !important
			}

			.container {
				width: 100%;
			}
		}
	</style>
	<title>barcode</title>

</head>

<body>

	<main>
		<div class="container">
			<div class="d-flex flex-column align-items-center">
				<a class="btn btn-primary" id="noprint" onclick="window.print()">طباعة</a>
			</div>
			<div class="invoice-box" id="printableArea">
				<div class="row">
					<div class="col-5">
						<table>
							<tbody>
								<tr>
									<td>
									اسم المنتج
									</td>
									<td>
										<div class="d-flex code">
											<img src="./assets/qr.png" class="img-fluid">
										</div>
									</td>
								</tr>
								<tr>
									<td>
										اللون:
										أسود
									</td>
									<td>
										90000009998
									</td>
								</tr>
								<tr>
									<td colspan="2">
										السعر:
										1600
										ريال
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<div class="d-flex gap-10 align-items-center">
                                            <img src="{{ asset('assets/ecommerce/img/special-pc-logo-dark.png') }}" class="img-fluid" width="44px">
											special pc
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</main>

    <script src="{{ asset('assets/ecommerce/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    </body>

</html>