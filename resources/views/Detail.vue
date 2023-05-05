<template>
    <v-container fluid>
        <h4 class="mb-5">ToDo詳細</h4>
        <div class="input-form">
            <v-row>
                <v-col cols="2" style="text-align: right; vertical-align: middle;">
                    タイトル:
                </v-col>
                <v-col cols="4">
                    <v-text-field density="compact" hide-details variant="solo"
                     class="inner-text" v-model="todoDetail.TODO_NAME"></v-text-field>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="2" style="text-align: right;">
                    ステータス:
                </v-col>
                <v-col cols="3">
                    <v-text-field density="compact" hide-details variant="solo"
                    class="inner-text" v-model="todoDetail.STATUS"></v-text-field>
                </v-col>
            </v-row>
        </div>
        <div class="mt-5">
            <v-row>
                <v-col cols="5">
                    <v-btn to="/" color="blue-grey-lighten-4">戻る</v-btn>
                </v-col>
                <v-col cols="2">
                    <v-btn v-if='props.todoId == null' @click="createTodo" color="blue-accent-2">新規作成</v-btn>
                    <v-btn v-else @click="updateTodo" color="blue-accent-2">更新</v-btn>
                </v-col>
            </v-row>
        </div>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
// 前画面（ホームからToDoIDを受け取る)
const props = defineProps({
    todoId: String
})


// ToDoデータ取得
const todoDetail = ref({  TODO_NAME: "", STATUS: "", CREATE_DATE: ""})
if (props.todoId != null) {
    onMounted(async () => {
        var res = await axios.post('getTodo', props)
        if (res.data != undefined) {
            todoDetail.value = res.data[0]
        }

    })
}

// 更新
const updateTodo = async () => {
    // ToDo情報にIDを付ける
    todoDetail.TODO_ID = props.todoId
    await axios.post('updateTodo', todoDetail.value);
}

// 新規作成
const createTodo = async () => {
    await axios.post('createTodo', todoDetail.value)
}
</script>
<style>
.input-form {
    font-size: 14px;
}

.inner-text input {
    padding: 0px 2px 0px 2px;
    min-height: 20px;
    font-size: 10px !important;
}

</style>
