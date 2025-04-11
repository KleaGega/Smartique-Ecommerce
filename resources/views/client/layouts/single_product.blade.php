<!-- Single product in view -->
<div class="col-12 col-sm-6 col-lg-4 col-xl-3">
	<div class="card product-card border-0 h-100 shadow-sm rounded-4 overflow-hidden" style="transition: all 0.4s ease;">
		<a href="/products/{{ $product->id }}" class="text-decoration-none text-dark ">
			<div class="position-relative">
				<div class="image-wrapper overflow-hidden" style="height: 300px;">
					<img src="/{{ $product->image_path }}" alt="{{ $product->name }}" class="img-fluid w-100 h-100" style="object-fit: cover; transition: transform 0.5s ease;">
				</div>
				<div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-0 hover-overlay" style="transition: opacity 0.4s ease;"></div>
			</div>
		</a>
		<div class="card-body p-4 d-flex flex-column justify-content-between">
			<h5 class="card-title fw-semibold mb-3" style="font-size: 1.1rem;">
				<a href="/products/{{ $product->id }}" class="text-decoration-none text-dark">
					{{ $product->name }}
				</a>
			</h5>
			<div class="mb-3">
				<span class="text-danger fw-bold fs-5">${{ number_format($product->price, 2) }}</span>
			</div>
			<a href="/products/{{ $product->id }}" class="btn btn-primary rounded-pill px-4 py-2 mt-auto shadow-sm" style="transition: all 0.3s ease;">
				See Details
			</a>
		</div>
	</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const productCards = document.querySelectorAll('.product-card');
  productCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.classList.remove('shadow-sm');
      this.classList.add('shadow-lg');
      this.style.transform = 'translateY(-8px)';
      
      const image = this.querySelector('.image-wrapper img');
      if (image) {
        image.style.transform = 'scale(1.07)';
      }
      
      const overlay = this.querySelector('.bg-dark');
      if (overlay) {
        overlay.style.opacity = '0.1';
      }
      
      const button = this.querySelector('.btn-primary');
      if (button) {
        button.style.backgroundColor = '#0056b3'; 
        button.style.paddingLeft = '2rem';
        button.style.paddingRight = '2rem';
      }
    });
    
    card.addEventListener('mouseleave', function() {
      this.classList.remove('shadow-lg');
      this.classList.add('shadow-sm');
      this.style.transform = 'translateY(0)';
      
      const image = this.querySelector('.image-wrapper img');
      if (image) {
        image.style.transform = 'scale(1)';
      }
      
      const overlay = this.querySelector('.bg-dark');
      if (overlay) {
        overlay.style.opacity = '0';
      }
      
      const button = this.querySelector('.btn-primary');
      if (button) {
        button.style.backgroundColor = '';
        button.style.paddingLeft = '1.75rem';
        button.style.paddingRight = '1.75rem';
      }
    });
  });
});
</script>