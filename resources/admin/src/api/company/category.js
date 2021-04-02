import Request from '@/axios/request'

export function getCategory(params) {
  return Request.get('category', { params })
}

export function createCategory() {
  return Request.get('category/create')
}

export function storeCategory(data) {
  return Request.post('category', data)
}

export function updateCategory(id, data) {
  return Request.put(`category/${id}`, data)
}

export function editCategory(id) {
  return Request.get(`category/${id}/edit`)
}

export function destroyCategory(id) {
  return Request.delete(`category/${id}`)
}
