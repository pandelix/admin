<template>
  <page-content center>
    <lz-form
      :get-data="getData"
      :submit="onSubmit"
      :form.sync="form"
      :errors.sync="errors"
    >
      <a-form-item label="制度名称:" required prop="name">
        <a-input v-model="form.name"/>
      </a-form-item>
      <a-form-item label="制度内容" required prop="content">
        <div id="content"/>
      </a-form-item>
      <a-form-item label="状态" required prop="status">
        <a-checkbox :checked="form.status" @change="changeStatus">启用</a-checkbox>
      </a-form-item>
      <a-form-item label="排序" prop="sort">
        <a-input v-model="form.sort"/>
      </a-form-item>
    </lz-form>
  </page-content>
</template>

<script>
import LzForm from '@c/LzForm'
import PageContent from '@c/PageContent'
import {
  createRule,
  editRule,
  storeRule,
  updateRule,
} from '@/api/rule'
import wangEditor from 'wangeditor'

export default {
  name: 'Form',
  components: {
    LzForm,
    // LzFormItem,
    PageContent,
  },
  data() {
    return {
      form: {
        name: '',
        simple_name: '',
        content: '',
        status: true,
        sort: '',
      },
      errors: {},
      editor: null,
    }
  },
  mounted() {
    const editor = new wangEditor('#content')

    /* editor.customConfig.uploadImgServer = '你的上传地址'
    editor.customConfig.uploadFileName = 'file'
    editor.customConfig.zIndex = 100
    editor.customConfig.uploadImgParams = {
      from: 'editor',
    }
    editor.customConfig.showFullScreen = true
    editor.customConfig.lineHeights = ['1', '1.15', '1.6', '2', '2.5', '3']
    editor.customConfig.menus = [
      'head', // 标题
      'bold', // 粗体
      'fontSize', // 字号
      'fontName', // 字体
      'italic', // 斜体
      'underline', // 下划线
      'strikeThrough', // 删除线
      'foreColor', // 文字颜色
      'backColor', // 背景颜色
      'justify', // 对齐方式
      'image', // 插入图片
      'table', // 表格
    ] */

    editor.config.onchange = (newHtml) => { // 配置 onchange 回调函数，将数据同步到 vue 中
      this.form.content = newHtml
    }
    editor.create() // 创建编辑器
    this.editor = editor
  },
  methods: {
    async getData($form) {
      let data
      if ($form.realEditMode) {
        ({ data } = await editRule($form.resourceId))
      } else {
        ({ data } = await createRule())
      }
      this.editor.txt.html(data.content)
      data.status = data.status > 0
      return data
    },
    async onSubmit($form) {
      if ($form.realEditMode) {
        this.form.status = this.form.status === true ? 1 : 0
        await updateRule($form.resourceId, this.form)
      } else {
        await storeRule(this.form)
      }
    },

    changeStatus(e) {
      this.form.status = e.target.checked
    },
  },
  beforeDestroy() {
    // 调用销毁 API 对当前编辑器实例进行销毁
    this.editor.destroy()
    this.editor = null
  },
}
</script>
