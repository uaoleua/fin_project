<x-app-layout>

    <div class="py-12" style="background-color: #b3c3d3; min-height: 100vh">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Ви увійшли!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    setTimeout(function(){
        window.location.href = "{{ url('/') }}"; // перенаправлення на головну сторінку
    }, 4000); // 4000 мілісекунд (або 4 секунд)
</script>
