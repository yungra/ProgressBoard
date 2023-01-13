<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            宿題機能
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="text-gray-600 body-font relative">

                        <div class="input-area">
                            <input id="add-text" placeholder="TODOを入力" />
                            <button id="add-button">追加</button>
                        </div>
                        <div class="incomplete-area">
                            <p class="title">未完了のTODO</p>
                            <ul id="incomplete-list">
                            </ul>
                        </div>
                        <div class="complete-area">
                            <p class="title">完了したTODO</p>
                            <ul id="complete-list">
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const onClickAdd = () => {
        // テキストボックスの値を取得し、初期化する
        const inputText = document.getElementById("add-text").value;
        document.getElementById("add-text").value = "";

        createIncompleteList(inputText);
    };

    // 未完了リストから指定の要素を削除
    const deleteFromIncompleteList = (target) => {
        document.getElementById("incomplete-list").removeChild(target);
    };

    // 未完了リストに追加する関数
    const createIncompleteList = (text) => {
        // div生成
        const div = document.createElement("div");
        div.className = "list-row";

        // liタグ生成
        const li = document.createElement("li");
        li.innerText = text;

        // button(完了)タグ生成
        const completeButton = document.createElement("button");
        completeButton.innerText = "完了";
        completeButton.addEventListener("click", () => {
            // 押された完了ボタンの親タグ(div)を未完了リストから削除
            deleteFromIncompleteList(completeButton.parentNode);

            // 完了リストに追加する要素
            const addTarget = completeButton.parentNode;

            // TODO内容テキストを取得
            const text = addTarget.firstElementChild.innerText;

            // div以下を初期化;
            addTarget.textContent = null;

            // liタグ生成
            const li = document.createElement("li");
            li.innerText = text;

            // buttonタグ生成
            const backButton = document.createElement("button");
            backButton.innerText = "戻す";
            backButton.addEventListener("click", () => {
                // 押された戻すボタンの親タグ（div）を完了リストから削除
                const deleteTarget = backButton.parentNode;
                document.getElementById("complete-list").removeChild(deleteTarget);

                // テキスト取得
                const text = backButton.parentNode.firstElementChild.innerText;
                createIncompleteList(text);

            })

            // divタグの子要素に各要素を設定
            addTarget.appendChild(li);
            addTarget.appendChild(backButton);
            console.log(addTarget);

            // 完了リストに追加する要素
            document.getElementById("complete-list").appendChild(addTarget);

            // 押された完了ボランの親タグ(div)を完了リストへ移動
            // console.log(completeTarget);

            // document.getElementById("complete-list").appendChild(completeTarget);
        });

        // button(削除)タグ生成
        const deleteButton = document.createElement("button");
        deleteButton.innerText = "削除";
        deleteButton.addEventListener("click", () => {
            // 押された削除ボタンの親タグ(div)を未完了リストから削除
            deleteFromIncompleteList(deleteButton.parentNode);
        });

        // divタグの子要素に各要素を設定
        div.appendChild(li);
        div.appendChild(completeButton);
        div.appendChild(deleteButton);

        // 未完了のリストに追加
        document.getElementById("incomplete-list").appendChild(div);
    };

    document
        .getElementById("add-button")
        .addEventListener("click", () => onClickAdd());
</script>

<style>
    body {
        font-family: sans-serif;
    }

    input {
        border-radius: 16px;
        border: none;
        padding: 6px 16px;
        outline: none;
    }

    button {
        background-color: #dcdcdc;
        border-radius: 16px;
        border: none;
        padding: 4px 16px;
    }

    button:hover {
        background-color: #ff7fff;
        color: #fff;
        cursor: pointer;
    }

    li {
        margin-right: 8px;
    }

    .input-area {
        background-color: #c1ffff;
        width: 400px;
        /* height: 30px; */
        padding: 8px;
        margin: 8px;
        border-radius: 8px;
    }

    .incomplete-area {
        background-color: #c6ffe2;
        width: 400px;
        min-height: 200px;
        padding: 8px;
        margin: 8px;
        border-radius: 8px;
    }

    .complete-area {
        background-color: #ffffe0;
        width: 400px;
        min-height: 200px;
        padding: 8px;
        margin: 8px;
        border-radius: 8px;
    }

    .title {
        text-align: center;
        margin-top: 0;
        font-weight: bold;
        color: #666;
    }

    .list-row {
        display: flex;
        align-items: center;
        padding-bottom: 4px;
    }
</style>
