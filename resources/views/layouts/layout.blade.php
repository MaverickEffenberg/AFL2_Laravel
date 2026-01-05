<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>My Carnivlora</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
</head>

<body>

    {{-- Header --}}
    @include('layouts.header')

    <main class="grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>

    @if(session('promotion_popup') && (!auth()->check() || auth()->user()->role !== 'admin'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var promo = @json(session('promotion_popup'));
                var modalHtml = '\n                <div class="modal fade" id="promoModal" tabindex="-1" role="dialog" aria-hidden="true">\n                  <div class="modal-dialog modal-dialog-centered" role="document">\n                    <div class="modal-content">\n                      <div class="modal-header">\n                        <h5 class="modal-title">Promotion Available</h5>\n                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">\n                          <span aria-hidden="true">&times;</span>\n                        </button>\n                      </div>\n                      <div class="modal-body">\n                        <p><strong>' + (promo.title || '') + '</strong></p>\n                        <p>' + (promo.description || '') + '</p>\n                      </div>\n                    </div>\n                  </div>\n                </div>';
                document.body.insertAdjacentHTML('beforeend', modalHtml);
                $('#promoModal').modal('show');
            });
        </script>
    @endif

</body>
</html>