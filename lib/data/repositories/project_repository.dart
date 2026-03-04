// lib/data/repositories/project_repository.dart
// ─────────────────────────────────────────────────────────────────────────────

import 'package:sqflite/sqflite.dart';
import 'package:portfolioph/data/datasources/local/database_service.dart';
import 'package:portfolioph/data/models/project_model.dart';

class ProjectRepository {
  final DatabaseService _db;

  ProjectRepository({DatabaseService? databaseService})
    : _db = databaseService ?? DatabaseService();

  Future<int> insert(ProjectModel project) async {
    final db = await _db.getDatabase();
    return db.insert(
      'projects',
      project.toMap(),
      conflictAlgorithm: ConflictAlgorithm.abort,
    );
  }

  Future<ProjectModel?> findById(int id) async {
    final db = await _db.getDatabase();
    final rows = await db.query(
      'projects',
      where: 'id = ?',
      whereArgs: [id],
      limit: 1,
    );
    return rows.isEmpty ? null : ProjectModel.fromMap(rows.first);
  }

  Future<List<ProjectModel>> findByPortfolioId(int portfolioId) async {
    final db = await _db.getDatabase();
    final rows = await db.query(
      'projects',
      where: 'portfolio_id = ?',
      whereArgs: [portfolioId],
      orderBy: 'sort_order ASC, created_at DESC',
    );
    return rows.map(ProjectModel.fromMap).toList();
  }

  Future<List<ProjectModel>> findFeaturedByUserId(int userId) async {
    final db = await _db.getDatabase();
    final rows = await db.query(
      'projects',
      where: 'user_id = ? AND is_featured = 1',
      whereArgs: [userId],
      orderBy: 'sort_order ASC',
    );
    return rows.map(ProjectModel.fromMap).toList();
  }

  Future<int> update(ProjectModel project) async {
    final db = await _db.getDatabase();
    return db.update(
      'projects',
      project.toMap(),
      where: 'id = ?',
      whereArgs: [project.id],
    );
  }

  Future<int> delete(int id) async {
    final db = await _db.getDatabase();
    return db.delete('projects', where: 'id = ?', whereArgs: [id]);
  }
}
