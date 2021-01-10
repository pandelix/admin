import Request from '@/axios/request'

export function getType(params) {
  return Request.get('type', { params })
}

export function createType() {
  return Request.get('type/create')
}

export function storeType(data) {
  return Request.post('type', data)
}

export function updateType(id, data) {
  return Request.put(`type/${id}`, data)
}

export function editType(id) {
  return Request.get(`type/${id}/edit`)
}

export function destroyType(id) {
  return Request.delete(`type/${id}`)
}
