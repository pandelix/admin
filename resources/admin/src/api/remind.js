import Request from '@/axios/request'

export function getRemind(params) {
  return Request.get('remind', { params })
}

export function createRemind() {
  return Request.get('remind/create')
}

export function storeRemind(data) {
  return Request.post('remind', data)
}

export function updateRemind(id, data) {
  return Request.put(`remind/${id}`, data)
}

export function editRemind(id) {
  return Request.get(`remind/${id}/edit`)
}

export function destroyRemind(id) {
  return Request.delete(`remind/${id}`)
}
