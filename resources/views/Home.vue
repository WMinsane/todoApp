<template>
    <v-container fluid>
        <h4 class="mb-5">ToDo一覧</h4>
        <div class="table-list">
            <v-table density="compact">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>タイトル</th>
                        <th>ステータス</th>
                        <th>作成日</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in todoList" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td>{{ item.TODO_NAME }}</td>
                        <td>{{ item.STATUS }}</td>
                        <td>{{ item.CREATE_DATE }}</td>
                        <td>
                            <v-btn @click="moveTodoDetail(item.TODO_ID)" density="compact" class="mx-4"
                                color="green">更新</v-btn>
                            <v-btn @click="deleteTodo(item.TODO_ID)" density="compact" color="red">削除</v-btn>
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </div>
        <div class="mt-5">
            <v-row>
                <v-col cols="10"></v-col>
                <v-col cols="1">
                    <v-btn @click="createTodo" color="blue-accent-2">新規作成</v-btn>
                </v-col>
            </v-row>
        </div>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

// 一覧取得
const todoList = ref([])
onMounted(async () => {
    var res = await axios.get('getTodoList')
    console.log(JSON.stringify(res))
    todoList.value = res.data
})

// 詳細に遷移(更新モード)
const router = useRouter()
const moveTodoDetail = (todoId) => {
    router.push({ name: 'detail', params: { todoId: todoId } })
}

// 詳細に遷移(新規モード)
const createTodo = () => {
    router.push({ name: 'detail' })
}

// 削除
const deleteTodo = async (todoId) => {
    await axios.post('deleteTodo',  {todoId: todoId})
    var res = await axios.get('getTodoList')
    todoList.value = res.data
} 

</script>
