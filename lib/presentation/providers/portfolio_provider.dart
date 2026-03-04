// lib/presentation/providers/portfolio_provider.dart
// ─────────────────────────────────────────────────────────────────────────────
// Manages the active user's portfolios and their nested data.
// TODO (Sprint 2+): populate with full CRUD logic as screens are built.
// ─────────────────────────────────────────────────────────────────────────────

import 'package:flutter/foundation.dart';

import 'package:portfolioph/data/models/portfolio_model.dart';
import 'package:portfolioph/data/models/project_model.dart';
import 'package:portfolioph/data/repositories/portfolio_repository.dart';
import 'package:portfolioph/data/repositories/project_repository.dart';

class PortfolioProvider extends ChangeNotifier {
  final PortfolioRepository _portfolioRepo;
  final ProjectRepository _projectRepo;

  List<PortfolioModel> _portfolios = [];
  List<ProjectModel> _featuredProjects = [];
  bool _isLoading = false;
  String? _errorMessage;

  PortfolioProvider({
    PortfolioRepository? portfolioRepository,
    ProjectRepository? projectRepository,
  }) : _portfolioRepo = portfolioRepository ?? PortfolioRepository(),
       _projectRepo = projectRepository ?? ProjectRepository();

  // ── Getters ──────────────────────────────────────────────────────────────────
  List<PortfolioModel> get portfolios => List.unmodifiable(_portfolios);
  List<ProjectModel> get featuredProjects =>
      List.unmodifiable(_featuredProjects);
  bool get isLoading => _isLoading;
  String? get errorMessage => _errorMessage;

  // ── Fetch ─────────────────────────────────────────────────────────────────────
  Future<void> loadForUser(int userId) async {
    _isLoading = true;
    _errorMessage = null;
    notifyListeners();
    try {
      _portfolios = await _portfolioRepo.findByUserId(userId);
      _featuredProjects = await _projectRepo.findFeaturedByUserId(userId);
    } catch (e) {
      _errorMessage = e.toString();
    } finally {
      _isLoading = false;
      notifyListeners();
    }
  }

  // ── Create ────────────────────────────────────────────────────────────────────
  Future<bool> addPortfolio(PortfolioModel portfolio) async {
    try {
      final id = await _portfolioRepo.insert(portfolio);
      _portfolios = [..._portfolios, portfolio.copyWith(id: id)];
      notifyListeners();
      return true;
    } catch (e) {
      _errorMessage = e.toString();
      notifyListeners();
      return false;
    }
  }

  void clearError() {
    _errorMessage = null;
    notifyListeners();
  }
}
