import Request from '@/axios/request'

export function getDictItems(params) {
  return Request.get('dict_items', { params })
}

export function createDictItem() {
  return Request.get('dict_items/create')
}

export function storeDictItem(data) {
  return Request.post('dict_items', data)
}

export function updateDictItem(id, data) {
  return Request.put(`dict_items/${id}`, data)
}

export function editDictItem(id) {
  return Request.get(`dict_items/${id}/edit`)
}

export function destroyDictItem(id) {
  return Request.delete(`dict_items/${id}`)
}
