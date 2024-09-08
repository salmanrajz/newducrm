@extends('layouts/contentLayoutMaster')

@section('title', 'Training')

@section('content')
<!-- Basic Horizontal form layout section start -->

<!-- Basic Horizontal form layout section end -->

<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
  <div class="row">

    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Add Training</h4>
        </div>
        <div class="card-body">
          <form class="form form-vertical"  id="MyRoleForm">
            <div class="row">
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Training Page Name</label>
                    <h1>{{$role->page_name}}</h1>
                </div>

              </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label" for="first-name-icon">Trainign Page Description</label>
                    @php echo $role->description; @endphp
                </div>

              </div>
              <div class="col-12">
                @if($role->docs_url != 'default.pdf')
                    {{-- {{$role->docs_url}} --}}
                   <div>
  <button id="prev" type="button">Previous</button>
  <button id="next" type="button">Next</button>
  &nbsp; &nbsp;
  <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
</div>
                    <input type="hidden" name="docs_url" id="docs_url" value="https://salmanrajzzdiag.blob.core.windows.net/vocus/documents/{{$role->docs_url}}">

                    <canvas id="the-canvas"></canvas>
                @endif
              </div>

              <div class="col-12">
                @if($role->id != 1)
                <button type="button" class="btn btn-primary me-1" onclick="window.location.href='{{route('training.page',$role->id - 1)}}'">Previous Topic</button>
                @endif
                <button type="button" class="btn btn-primary me-1" onclick="window.location.href='{{route('training.page',$role->id + 1)}}'">Next Topic</button>
                {{-- <button type="reset" class="btn btn-outline-secondary">Reset</button> --}}
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</section>
<!-- Basic Vertical form layout section end -->

<!-- Basic multiple Column Form section start -->


@endsection<!-- Basic Floating Label Form section end -->
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/custom.js'))}}"></script>
  <!-- Page js files -->
<script src="https://cdn.tiny.cloud/1/2mrbou8da9x4ojjd4wsp5gqez8qhlsee7z5myu0wy8ewepu7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  {{-- <script src="https://cdn.tiny.cloud/1/2mrbou8da9x4ojjd4wsp5gqez8qhlsee7z5myu0wy8ewepu7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
  <script>
    tinymce.init({
  selector: '#TrainingDesc',
  height: 500,
  width: '100%',
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen codesample',
    'insertdatetime media table paste imagetools wordcount spellchecker fullpage'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image codesample fullscreen',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:18px }'
});
//
</script>

<script src="//mozilla.github.io/pdf.js/build/pdf.mjs" type="module"></script>

<script type="module">
  // If absolute URL from the remote server is provided, configure the CORS
  // header on that server.
    var url = $("#docs_url").val();

//   var url = 'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf';

  // Loaded via <script> tag, create shortcut to access PDF.js exports.
  var { pdfjsLib } = globalThis;

  // The workerSrc property shall be specified.
  pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.mjs';

  var pdfDoc = null,
      pageNum = 1,
      pageRendering = false,
      pageNumPending = null,
      scale = 0.8,
      canvas = document.getElementById('the-canvas'),
      ctx = canvas.getContext('2d');

  /**
   * Get page info from document, resize canvas accordingly, and render page.
   * @param num Page number.
   */
  function renderPage(num) {
    pageRendering = true;
    // Using promise to fetch the page
    pdfDoc.getPage(num).then(function(page) {
      var viewport = page.getViewport({scale: scale});
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      // Render PDF page into canvas context
      var renderContext = {
        canvasContext: ctx,
        viewport: viewport
      };
      var renderTask = page.render(renderContext);

      // Wait for rendering to finish
      renderTask.promise.then(function() {
        pageRendering = false;
        if (pageNumPending !== null) {
          // New page rendering is pending
          renderPage(pageNumPending);
          pageNumPending = null;
        }
      });
    });

    // Update page counters
    document.getElementById('page_num').textContent = num;
  }

  /**
   * If another page rendering in progress, waits until the rendering is
   * finised. Otherwise, executes rendering immediately.
   */
  function queueRenderPage(num) {
    if (pageRendering) {
      pageNumPending = num;
    } else {
      renderPage(num);
    }
  }

  /**
   * Displays previous page.
   */
  function onPrevPage() {
    if (pageNum <= 1) {
      return;
    }
    pageNum--;
    queueRenderPage(pageNum);
  }
  document.getElementById('prev').addEventListener('click', onPrevPage);

  /**
   * Displays next page.
   */
  function onNextPage() {
    if (pageNum >= pdfDoc.numPages) {
      return;
    }
    pageNum++;
    queueRenderPage(pageNum);
  }
  document.getElementById('next').addEventListener('click', onNextPage);

  /**
   * Asynchronously downloads PDF.
   */
  pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
    pdfDoc = pdfDoc_;
    document.getElementById('page_count').textContent = pdfDoc.numPages;

    // Initial/first page rendering
    renderPage(pageNum);
  });
</script>





@endsection
