<footer class="bg-slate-200 text-gray-200 mt-8">
    <div class="bg-gray-800">
        <div class="container mx-auto flex justify-between items-center py-4 text-white">
            <div class="text-sm">
                &copy; {{ date('Y') }} {{ config('app.name', 'Ecommerce') }}. All rights reserved.
            </div>
            <div class="text-sm">
                <a href="" class="text-gray-400 hover:text-white">Privacy Policy</a> |
                <a href="" class="text-gray-400 hover:text-white">Terms of Service</a>
            </div>
        </div>
    </div>
    <div class="text-center text-sm text-gray-500 py-2">
        <p>Developed by <i class='bx bxs-heart text-red-500'></i> <a href="{{ url('https://mahfuz-ahmed.vercel.app') }}"
                target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:underline">Mahfuz Ahmed</a></p>
    </div>
</footer>
