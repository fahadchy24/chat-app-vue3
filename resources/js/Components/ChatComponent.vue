<script setup>
import axios from "axios";
import { nextTick, onMounted, ref, watch } from "vue";

const props = defineProps({
    friend: {
        type: Object,
        required: true,
    },
    currentUser: {
        type: Object,
        required: true,
    },
});

const messages = ref([]);
const newMessage = ref("");
const messagesContainer = ref("");

watch(messages, () =>{
    nextTick(() => {
        // messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
        messagesContainer.value.scrollTo({
            top: messagesContainer.value.scrollHeight,
            behavior: "smooth",
        })
    });
}, {deep: true});

const sendMessage = () => {
    if (newMessage.value.trim() !== "") {
        axios
            .post(`/messages/${props.friend.id}`, {
                message: newMessage.value,
            })
            .then((response) => {
                messages.value.push(response.data.message);
                newMessage.value = "";
            });
    }
};

onMounted(() => {
    axios.get(`/messages/${props.friend.id}`).then((response) => {
        messages.value = response.data;
    });

    Echo.private(`chat.${props.currentUser.id}`)
        .listen('ChatMessageEvent', (response) => {
            messages.value.push(response.message);
        });
});

</script>

<template>
    <div>
        <div class="flex flex-col justify-end h-80">
            <div ref="messagesContainer" class="p-4 overflow-y-auto max-h-fit">
                <div
                    v-for="message in messages"
                    :key="message.id"
                    class="flex items-center mb-2"
                >
                    <div
                        v-if="message.sender_id === currentUser.id"
                        class="p-2 ml-auto text-white bg-blue-500 rounded-lg"
                    >
                        {{ message.message }}
                    </div>
                    <div v-else class="p-2 mr-auto bg-gray-200 rounded-lg">
                        {{ message.message }}
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center">
            <input
                type="text"
                v-model="newMessage"
                @keyup.enter="sendMessage"
                placeholder="Type a message..."
                class="flex-1 px-2 py-1 border rounded-lg"
            />
            <button
                @click="sendMessage"
                class="px-4 py-1 ml-2 text-white bg-blue-500 rounded-lg"
            >
                Send
            </button>
        </div>
    </div>
</template>
