<div x-data="restaurantList">
    <h1 class="text-2xl">
        THIS IS THE JS VERSION
    </h1>
    <div class="grid grid-cols-3 gap-4">
        <template x-for="restaurant in restaurants" :key="restaurant.id">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <img x-bind:src="restaurant.logo" alt="restaurant.name" class="w-20 object-cover">
                    <div class="text-2xl font-bold text-gray-800" x-text="restaurant.name"></div>
                    <div class="text-lg text-gray-500" x-text="restaurant.description"></div>
                </div>
            </div>
        </template>
    </div>


</div>

<script type="text/javascript">
    document.addEventListener('alpine:init', () => {
        Alpine.data('restaurantList', () => ({
            restaurants: [],
            loadRestaurants() {
                fetch('/api/restaurants')
                    .then(response => response.json())
                    .then(data => {
                        this.restaurants = data.restaurants;

                    });
            },
            init() {
                this.loadRestaurants();
            }
        }))
    })
</script>

