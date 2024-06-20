<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';

const props = defineProps({
    users: Object,
});

</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            <template v-for="user in users" :key="user.id">
                                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                                    <div class="p-6">
                                        <div class="flex items-center">
                                            <Link :href="route('chat', user.id)">
                                                <span class="text-lg font-medium">{{ user.name }}</span>
                                            </Link>
                                        </div>
                                        <p class="text-gray-500 text-sm">{{ user.email }}</p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
